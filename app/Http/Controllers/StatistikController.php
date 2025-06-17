<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\StatusPengaduan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class StatistikController extends Controller
{
    public function index()
    {
        // Data untuk kartu ringkasan
        $totalPengaduan = Pengaduan::count();
        $statusCounts = Pengaduan::select('status_id', DB::raw('count(*) as total'))
                        ->groupBy('status_id')
                        ->pluck('total', 'status_id')
                        ->toArray();

        // Data untuk grafik kategori
        $kategoriData = Kategori::withCount('pengaduan')
                        ->orderBy('pengaduan_count', 'desc')
                        ->get();

        // Data untuk grafik status
        $statusData = StatusPengaduan::withCount('pengaduan')
                        ->get()
                        ->map(function ($status) use ($totalPengaduan) {
                            $status->percentage = $totalPengaduan > 0 ?
                                round(($status->pengaduan_count / $totalPengaduan) * 100) : 0;
                            return $status;
                        });

        // Data untuk grafik bulanan
        $bulanLabels = [];
        $bulanTotal = [];
        $bulanSelesai = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulanLabels[] = $date->format('M');

            $bulanTotal[] = Pengaduan::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->count();

            $bulanSelesai[] = Pengaduan::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->where('status_id', 3)
                            ->count();
        }

        return view('admin.statistik', compact(
            'totalPengaduan',
            'statusCounts',
            'kategoriData',
            'statusData',
            'bulanLabels',
            'bulanTotal',
            'bulanSelesai'
        ));
    }

    public function exportPage()
    {
        $kategoris = Kategori::all();
        $statuses = StatusPengaduan::all();

        return view('admin.export', compact('kategoris', 'statuses'));
    }

    public function exportData(Request $request)
{
    $request->validate([
        'tanggal_mulai' => 'nullable|date',
        'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        'kategori_id' => 'nullable|exists:kategori,kategori_id',
        'status_id' => 'nullable|exists:status_pengaduan,status_id',
        'format' => 'required|in:excel,pdf',
    ]);

    $pengaduan = Pengaduan::with(['kategori', 'warga', 'status'])
        ->when($request->tanggal_mulai, fn ($q) =>
            $q->whereDate('created_at', '>=', $request->tanggal_mulai))
        ->when($request->tanggal_akhir, fn ($q) =>
            $q->whereDate('created_at', '<=', $request->tanggal_akhir))
        ->when($request->kategori_id, fn ($q) =>
            $q->where('kategori_id', $request->kategori_id))
        ->when($request->status_id, fn ($q) =>
            $q->where('status_id', $request->status_id))
        ->orderBy('created_at', 'desc')
        ->get();

    if ($request->format === 'excel') {
        $fileName = 'pengaduan_' . date('Y-m-d') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\PengaduanExport(
                $request->tanggal_mulai,
                $request->tanggal_akhir,
                $request->kategori_id,
                $request->status_id
            ),
            $fileName
        );
    }

    $html = '
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
    <h2>Data Pengaduan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Pelapor</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($pengaduan as $p) {
        $html .= '
        <tr>
            <td>' . $p->pengaduan_id . '</td>
            <td>' . $p->judul . '</td>
            <td>' . $p->deskripsi . '</td>
            <td>' . ($p->kategori->nama_kategori ?? '-') . '</td>
            <td>' . ($p->warga->nama ?? '-') . '</td>
            <td>' . ($p->status->nama_status ?? '-') . '</td>
            <td>' . $p->created_at->format('d/m/Y') . '</td>
        </tr>';
    }

    $html .= '</tbody></table>';

    $pdf = Pdf::loadHTML($html);
    return $pdf->download('pengaduan_' . date('Y-m-d') . '.pdf');
}
}
