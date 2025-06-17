<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil status_id dari tabel status_pengaduan yang nama_status-nya "Selesai"
        $laporanSelesai = Pengaduan::with(['status', 'kategori'])
            ->whereHas('status', function ($query) {
                $query->where('nama_status', 'Selesai');
            })
            ->take(6)
            ->get();

        return view('welcome', compact('laporanSelesai'));
    }
}
