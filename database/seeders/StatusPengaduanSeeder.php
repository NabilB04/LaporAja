<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['status_id' => 1, 'nama_status' => 'Baru'],
            ['status_id' => 2, 'nama_status' => 'Diproses'],
            ['status_id' => 3, 'nama_status' => 'Selesai'],
            ['status_id' => 4, 'nama_status' => 'Ditolak'],
        ];

        // Cek apakah data sudah ada, jika belum baru insert
        foreach ($statuses as $status) {
            $exists = DB::table('status_pengaduan')
                        ->where('status_id', $status['status_id'])
                        ->exists();

            if (!$exists) {
                DB::table('status_pengaduan')->insert($status);
            }
        }
    }
}
