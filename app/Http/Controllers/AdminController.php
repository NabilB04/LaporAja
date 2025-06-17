<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\StatusPengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

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

        $notifCount = 0;
        if (Schema::hasTable('pengaduan')) {
            $notifCount = Pengaduan::where('status', 'baru')->count();
        }
        return view('admin.dashboard', compact('notifCount'));
    }

    public function kelolaPengaduan(Request $request)
    {
        $query = Pengaduan::with(['warga', 'kategori']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
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

        $pengaduans = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.kelola-pengaduan', compact('pengaduans', 'kategoris'));
    }

    public function detailPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);
        return view('admin.detail-pengaduan', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
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

        $pengaduan = Pengaduan::findOrFail($id);
        $statusDitanggapi = StatusPengaduan::where('nama_status', 'ditanggapi')->first();
        if ($statusDitanggapi) {
            $pengaduan->update(['status_id' => $statusDitanggapi->status_id]);
        }

        return back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }

    public function profil()
    {
        $user = Auth::user();
        return view('admin.profil', compact('user'));
    }

    public function editProfil()
    {
        $user = Auth::user();
        return view('admin.edit-profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
     $admin = Auth::guard('admin')->user(); // Gunakan guard admin

    $request->validate([
        'nama' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update nama
    $admin->nama = $request->nama;

    // Jika password diisi, maka update
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}

