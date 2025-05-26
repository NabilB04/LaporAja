@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard Admin</h1>

    {{-- Statistik Ringkas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-blue-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm">Total Pengaduan</p>
            <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm">Pengaduan Baru</p>
            <p class="text-2xl font-bold">{{ $stats['baru'] }}</p>
        </div>
        <div class="bg-indigo-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm">Sedang Diproses</p>
            <p class="text-2xl font-bold">{{ $stats['diproses'] }}</p>
        </div>
        <div class="bg-green-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm">Pengaduan Selesai</p>
            <p class="text-2xl font-bold">{{ $stats['selesai'] }}</p>
        </div>
    </div>

    {{-- Tabel Pengaduan Terbaru --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Pengaduan Terbaru</h2>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-600">
                <tr>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Pelapor</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y">
                @forelse ($pengaduanTerbaru as $item)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $item->judul }}</td>
                    <td class="px-6 py-4">{{ $item->warga->nama ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @php
                            $status = strtolower($item->status->nama_status);
                            $badge = match($status) {
                                'baru' => 'bg-yellow-100 text-yellow-800',
                                'diproses' => 'bg-indigo-100 text-indigo-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $badge }}">
                            {{ ucfirst($item->status->nama_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.pengaduan.show', $item->pengaduan_id) }}"
                           class="text-sm text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada pengaduan terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
