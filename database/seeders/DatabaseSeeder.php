<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            'nama' => 'Super Admin',
            'email' => 'admin@laporaja.test',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
