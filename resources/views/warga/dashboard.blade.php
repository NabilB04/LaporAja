@extends('layouts.app')
@section('title', 'Dashboard Warga')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Halo, {{ Auth::guard('warga')->user()->nama }}! 👋</h1>

    {{-- Statistik Pengaduan --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-sm text-gray-500">Total Pengaduan</p>
            <p class="text-xl font-bold text-blue-600">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-sm text-gray-500">Baru</p>
            <p class="text-xl font-bold text-yellow-600">{{ $stats['baru'] }}</p>
        </div>
        <div class="bg-indigo-50 rounded-lg shadow p-4 text-center">
            <p class="text-sm text-gray-500">Diproses</p>
            <p class="text-xl font-bold text-indigo-600">{{ $stats['diproses'] }}</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-sm text-gray-500">Selesai</p>
            <p class="text-xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
        </div>
    </div>

    {{-- Daftar Pengaduan Terbaru --}}
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Pengaduan Terbaru</h2>
            <a href="{{ route('warga.pengaduan.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
        </div>

        @if ($pengaduan->isEmpty())
            <p class="text-gray-500">Belum ada pengaduan yang dibuat.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($pengaduan as $item)
                    <li class="py-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item->judul }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $item->kategori->nama_kategori }} • {{ $item->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600">
                                {{ ucfirst($item->status->nama_status) }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
