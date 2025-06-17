<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\StatusPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;


class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with(['kategori', 'status'])
            ->where('user_id', Auth::guard('warga')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('warga.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('warga.pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // dd(env('CLOUDINARY_URL'));
        $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'kategori_id.required' => 'Kategori harus dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'judul.required' => 'Judul pengaduan harus diisi',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi pengaduan harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
            'latitude.required' => 'Lokasi belum terdeteksi, silakan aktifkan GPS',
            'longitude.required' => 'Lokasi belum terdeteksi, silakan aktifkan GPS',
            'foto_bukti.required' => 'Foto bukti harus diupload',
            'foto_bukti.image' => 'File harus berupa gambar',
            'foto_bukti.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto_bukti.max' => 'Ukuran foto maksimal 2MB'
        ]);

        try {
        // Upload ke Cloudinary
        Configuration::instance('cloudinary://416662668893733:eFDO2XT4GRIdoPgH6BDi-dSjAMQ@dc9jdl8tu');

        // Upload ke Cloudinary
        $foto = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $result = (new UploadApi())->upload($file->getRealPath(), [
                'folder' => 'pengaduan_laporaja',
                'public_id' => time() . '_' . Str::random(10),
                'resource_type' => 'image',
            ]);
            $foto = $result['secure_url'] ?? null;

            if (!$foto) {
                throw new \Exception('Gagal upload gambar ke Cloudinary.');
            }
        }
            // Get status "Baru"
            $statusBaru = StatusPengaduan::where('nama_status', 'Baru')->first();
            if (!$statusBaru) {
                $statusBaru = StatusPengaduan::first();
            }

            // Simpan pengaduan
            $pengaduan = Pengaduan::create([
                'user_id' => Auth::guard('warga')->id(),
                'kategori_id' => $request->kategori_id,
                'status_id' => $statusBaru ? $statusBaru->status_id : 1,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'foto_bukti' => $foto
            ]);

            return redirect()->route('warga.pengaduan.index')
                ->with('success', 'Pengaduan berhasil dibuat! Tim kami akan segera menindaklanjuti.');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan pengaduan. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function showDetail($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'status', 'tanggapan'])->findOrFail($id);
        return view('warga.pengaduan.detail', compact('pengaduan'));
    }

}
