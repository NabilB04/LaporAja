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
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('warga')->insert([
            'nama' => 'Nabil',
            'email' => 'Nabil@gmail.com',
            'no_hp' => '08123467890',
            'alamat' => 'Jl.Tidar, Jember',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
        KategoriSeeder::class,
        StatusPengaduanSeeder::class,
        ]);
    }
}
