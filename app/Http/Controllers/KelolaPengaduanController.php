<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\StatusPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class KelolaPengaduanController extends Controller
{
    public function kelolaPengaduan(Request $request)
    {
        $query = Pengaduan::with(['warga', 'kategori', 'status']);

        if ($request->has('status') && $request->status != '') {
            $query->whereHas('status', function($q) use ($request) {
                $q->where('nama_status', $request->status);
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('warga', function($userQuery) use ($request) {
                      $userQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategori = Kategori::all();

        return view('admin.kelola-pengaduan', compact('pengaduan', 'kategori'));
    }

    public function detailPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori', 'status', 'tanggapan'])->findOrFail($id);
        return view('admin.detail-pengaduan', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $pengaduan_id)
    {
        $request->validate([
            'status' => 'required|in:Baru,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduan_id);
        $status = StatusPengaduan::where('nama_status', $request->status)->firstOrFail();

        $pengaduan->update([
            'status_id' => $status->status_id,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    public function createTanggapan($pengaduan_id){
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        $statusSekarang = $pengaduan->status->nama_status;

        if ($statusSekarang === 'Baru') {
            $opsiStatus = StatusPengaduan::whereIn('nama_status', ['Diproses', 'Ditolak'])->get();
        } elseif ($statusSekarang === 'Diproses') {
            $opsiStatus = StatusPengaduan::whereIn('nama_status', ['Diproses', 'Selesai'])->get();
        } else {
            return redirect()->back()->with('error', 'Pengaduan tidak bisa ditanggapi lagi.');
        }

        return view('admin.tanggapan.createTanggapan', compact('pengaduan', 'opsiStatus'));
    }

   public function storeTanggapan(Request $request, $pengaduan_id)
    {
         $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        $request->validate([
            'isi_tanggapan' => 'required|string',
            'status_id' => 'required|exists:status_pengaduan,status_id',
            'foto_tanggapan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        $data = [
            'pengaduan_id' => $pengaduan_id,
            'admin_id' => Auth::guard('admin')->id(),
            'isi_tanggapan' => $request->isi_tanggapan,
            'status_baru' => $request->status_id
        ];

        if ($request->hasFile('foto_tanggapan')) {
            $file = $request->file('foto_tanggapan');
            $uploadResult = (new UploadApi())->upload($file->getRealPath(), [
                'folder' => 'tanggapan_laporaja',
                'public_id' => time() . '_' . \Illuminate\Support\Str::random(10),
                'resource_type' => 'image'
            ]);

            $data['foto_tanggapan'] = $uploadResult['secure_url'] ?? null;

            if (!$data['foto_tanggapan']) {
                return back()->with('error', 'Gagal upload foto ke Cloudinary.');
            }
        }

        // Simpan tanggapan
        Tanggapan::create($data);

        // Update status pengaduan
        $pengaduan->update(['status_id' => $request->status_id]);

        return redirect()->route('admin.detail-pengaduan', $pengaduan->pengaduan_id)
            ->with('success', 'Tanggapan berhasil ditambahkan dan status pengaduan diperbarui!');
    }

    // laporan
    public function laporan(Request $request){
        $pengaduan = Pengaduan::with(['warga', 'kategori', 'status'])
            ->whereHas('status', function($q) {
                $q->where('nama_status', 'Selesai');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.laporan.laporan', compact('pengaduan'));
    }

    public function detaillaporan($id)
    {
       $pengaduan = Pengaduan::with(['warga', 'kategori', 'status', 'tanggapan'])->findOrFail($id);
        return view('warga.laporan.detaillaporan', compact('pengaduan'));
    }


}

// if ($request->hasFile('foto_tanggapan') && $request->file('foto_tanggapan')->isValid()) {
        //     $uploadedFile = $request->file('foto_tanggapan');
        //     $data['foto_tanggapan'] = Cloudinary::upload($uploadedFile->getRealPath())->getSecurePath();
        // }
