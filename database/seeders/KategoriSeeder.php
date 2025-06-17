<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            [
                'nama_kategori' => 'Infrastruktur',
            ],
            [
                'nama_kategori' => 'Layanan Publik',
            ],
            [
                'nama_kategori' => 'Lingkungan',
            ],
            [
                'nama_kategori' => 'Keamanan',
            ],
            [
                'nama_kategori' => 'Kesehatan',
            ],
            [
                'nama_kategori' => 'Pendidikan',
            ],
        ];

        DB::table('kategori')->insert($kategori);
    }
}
