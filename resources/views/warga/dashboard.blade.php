@extends('layouts.warga.app')
@section('title', 'Dashboard Warga')

@section('content')
<!-- Content -->
<div class="p-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div
            class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] rounded-lg shadow-md">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pengaduan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-md">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Baru</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['baru'] }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md">
                    <i class="fas fa-sync-alt text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Diproses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['diproses'] }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Selesai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['selesai'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10">
        <div class="px-6 py-4 border-b border-[#d46a6d]/10 bg-gradient-to-r from-[#f5e6d3] to-white">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Pengaduan Terbaru Anda</h3>
                <a href="{{ route('warga.pengaduan.index') }}"
                    class="text-[#d46a6d] hover:text-[#c55a5d] text-sm font-semibold transition-colors duration-200">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        @if($pengaduan->isEmpty())
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-[#f5e6d3] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-[#d46a6d] text-2xl"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum ada pengaduan</h4>
                <p class="text-gray-500 mb-6">Anda belum membuat pengaduan apapun. Mulai buat pengaduan pertama Anda.
                </p>
                <button
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] text-white rounded-lg hover:from-[#c55a5d] hover:to-[#b54a4d] transition-all duration-200 shadow-md hover:shadow-lg font-medium">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Buat Pengaduan
                </button>
            </div>
        @else
            <div class="divide-y divide-[#d46a6d]/10">
                @foreach($pengaduan as $item)
                    <div class="p-6 hover:bg-[#f5e6d3]/30 transition-all duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->judul }}</h4>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                            <div class="ml-4 flex flex-col items-end space-y-3">
                                @php
                                    $status = strtolower($item->status->nama_status);
                                    $badge = match($status) {
                                    'baru' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'selesai' => 'bg-green-100 text-green-800 border-green-200',
                                    default => 'bg-gray-100 text-gray-800 border-gray-200',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                                    {{ ucfirst($item->status->nama_status) }}
                                </span>
                                <button
                                    class="text-[#d46a6d] hover:text-[#c55a5d] text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</div>
</div>
</div>
@endsection
