<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\StatusPengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Pengaduan::count(),
            'baru' => Pengaduan::whereHas('status', function($q) {
                $q->where('nama_status', 'baru');
            })->count(),
            'diproses' => Pengaduan::whereHas('status', function($q) {
                $q->where('nama_status', 'diproses');
            })->count(),
            'selesai' => Pengaduan::whereHas('status', function($q) {
                $q->where('nama_status', 'selesai');
            })->count(),
        ];

        $pengaduanTerbaru = Pengaduan::with(['warga', 'kategori', 'status'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pengaduanTerbaru'));
    }

    public function indexPengaduan()
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori', 'status'])
            ->latest()
            ->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori', 'status', 'tanggapan.admin'])
            ->findOrFail($id);

        $statusList = StatusPengaduan::all();

        return view('admin.pengaduan.show', compact('pengaduan', 'statusList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:status_pengaduan,status_id'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status_id' => $request->status_id,
            'admin_id' => Auth::guard('admin')->id()
        ]);

        return back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    public function storeTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
            'foto_tanggapan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'pengaduan_id' => $id,
            'admin_id' => Auth::guard('admin')->id(),
            'isi_tanggapan' => $request->isi_tanggapan,
        ];

        if ($request->hasFile('foto_tanggapan')) {
            $file = $request->file('foto_tanggapan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tanggapan', $filename);
            $data['foto_tanggapan'] = $filename;
        }

        Tanggapan::create($data);

        // Update status to 'ditanggapi'
        $pengaduan = Pengaduan::findOrFail($id);
        $statusDitanggapi = StatusPengaduan::where('nama_status', 'ditanggapi')->first();
        if ($statusDitanggapi) {
            $pengaduan->update(['status_id' => $statusDitanggapi->status_id]);
        }

        return back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }
}
