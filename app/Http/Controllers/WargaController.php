<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\StatusPengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('warga')->user();

    $pengaduan = Pengaduan::where('user_id', $user->warga_id)
        ->with(['kategori', 'status'])
        ->latest()
        ->take(5)
        ->get();

    $stats = [
        'total' => Pengaduan::where('user_id', $user->warga_id)->count(),
        'baru' => Pengaduan::where('user_id', $user->warga_id)->whereHas('status', fn($q) => $q->where('nama_status', 'baru'))->count(),
        'diproses' => Pengaduan::where('user_id', $user->warga_id)->whereHas('status', fn($q) => $q->where('nama_status', 'diproses'))->count(),
        'selesai' => Pengaduan::where('user_id', $user->warga_id)->whereHas('status', fn($q) => $q->where('nama_status', 'selesai'))->count(),
    ];

    $notifikasi = Pengaduan::with(['status', 'tanggapan'])
        ->where('user_id', $user->warga_id)
        ->where(function ($query) {
            $query->whereHas('status', fn($q) => $q->whereIn('nama_status', ['diproses', 'selesai']))
                  ->orWhereHas('tanggapan');
        })
        ->latest()
        ->take(5)
        ->get();

    $notifikasi_count = $notifikasi->count();

    return view('warga.dashboard', compact('pengaduan', 'stats', 'notifikasi', 'notifikasi_count'));
    }

    public function createPengaduan()
    {
        $kategori = Kategori::all();
        return view('warga.pengaduan.create', compact('kategori'));
    }

    public function storePengaduan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'user_id' => Auth::guard('warga')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'kategori_id' => $request->kategori_id,
            'status_id' => 1,
        ];

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pengaduan', $filename);
            $data['foto_bukti'] = $filename;
        }

        Pengaduan::create($data);

        return redirect()->route('warga.pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');
    }

    public function indexPengaduan()
    {
        $user = Auth::guard('warga')->user();
        $pengaduan = Pengaduan::where('user_id', $user->warga_id)
            ->with(['kategori', 'status', 'tanggapan'])
            ->latest()
            ->paginate(10);

        return view('warga.pengaduan.index', compact('pengaduan'));
    }

    public function showPengaduan($id)
    {
        $user = Auth::guard('warga')->user();
        $pengaduan = Pengaduan::where('user_id', $user->warga_id)
            ->where('pengaduan_id', $id)
            ->with(['kategori', 'status', 'tanggapan.admin'])
            ->firstOrFail();

        return view('warga.pengaduan.show', compact('pengaduan'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('warga.profil', compact('user'));
    }

    public function editProfil()
    {
        $user = Auth::user();
        return view('warga.edit-profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::guard('warga')->user();

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:warga,email,' . $user->warga_id . ',warga_id', // sesuaikan dengan nama kolom PK
        'no_hp' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update data umum
    $user->nama = $request->nama;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;
    $user->alamat = $request->alamat;

    // Jika password baru diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('warga.profil')->with('success', 'Profil berhasil diperbarui.');
    }

}
