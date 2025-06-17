@extends('layouts.warga.app')

@section('content')
<div class="px-6 py-4">
    <h2 class="text-2xl font-semibold mb-4">Profil Saya</h2>

    <div class="bg-white rounded-xl shadow p-6 flex items-start gap-6 w-full md:w-2/3">
        <!-- Foto Profil -->
        <div class="flex-shrink-0">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('warga')->user()->nama) }}&background=E74C3C&color=fff&size=128"
                alt="Avatar"
                class="w-24 h-24 rounded-full border shadow">
        </div>

        <!-- Info Profil -->
        <div class="flex-1 text-center md:text-left">
            <p class="text-2xl font-semibold text-gray-900">{{ Auth::guard('warga')->user()->nama }}</p>
            <p class="text-gray-500 text-sm mt-1">{{ Auth::guard('warga')->user()->email }}</p>

            <div class="mt-4 text-sm text-gray-700 space-y-1">
                <p><strong>No HP:</strong> {{ Auth::guard('warga')->user()->no_hp ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ Auth::guard('warga')->user()->alamat ?? '-' }}</p>
            </div>

            <a href="{{ route('warga.editProfil') }}"
               class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
