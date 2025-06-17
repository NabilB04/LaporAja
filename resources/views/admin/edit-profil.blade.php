@extends('layouts.admin.app')

@section('content')
<div class="px-6 py-4">
    <h2 class="text-2xl font-semibold mb-4">Edit Profil</h2>
    <div class="bg-white rounded-xl shadow p-6 w-full md:w-2/3">
        <form method="POST" action="{{ route('admin.updateProfil') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-2 border rounded">
            </div>

           <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password Baru (Opsional)</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded" placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.profil') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    ← Kembali ke Profil
                </a>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
