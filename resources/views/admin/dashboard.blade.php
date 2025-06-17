@extends('layouts.admin.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="p-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] rounded-lg shadow-md">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pengaduan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    <p class="text-xs text-gray-500">+12% dari bulan lalu</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-md">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pengaduan Baru</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['baru'] }}</p>
                    <p class="text-xs text-gray-500">Perlu ditindaklanjuti</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md">
                    <i class="fas fa-sync-alt text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sedang Diproses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['diproses'] }}</p>
                    <p class="text-xs text-gray-500">Dalam penanganan</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-6 hover:shadow-lg transition-all duration-200">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Selesai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['selesai'] }}</p>
                    <p class="text-xs text-gray-500">+8% dari bulan lalu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10">
        <div class="px-6 py-4 border-b border-[#d46a6d]/10 bg-gradient-to-r from-[#f5e6d3] to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Pengaduan Terbaru</h3>
                    <p class="text-sm text-gray-600">Daftar pengaduan yang baru masuk</p>
                </div>
                <a href="{{ route('admin.kelola-pengaduan') }}"
                   class="text-[#d46a6d] hover:text-[#c55a5d] text-sm font-semibold transition-colors duration-200">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengaduanTerbaru as $pengaduan)
                        <tr class="hover:bg-[#f5e6d3]/30 transition-all duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $pengaduan->judul }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($pengaduan->deskripsi, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $pengaduan->warga->nama ?? 'Tidak Tersedia' }}</div>
                                <div class="text-sm text-gray-500">{{ $pengaduan->warga->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $pengaduan->kategori->nama_kategori ?? 'Tidak Tersedia' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($pengaduan->status->nama_status == 'Baru')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-yellow-100 text-yellow-800 border-yellow-200">
                                        Baru
                                    </span>
                                @elseif ($pengaduan->status->nama_status == 'Diproses')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-blue-100 text-blue-800 border-blue-200">
                                        Diproses
                                    </span>
                                @elseif ($pengaduan->status->nama_status == 'Selesai')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-green-100 text-green-800 border-green-200">
                                        Selesai
                                    </span>
                                @elseif ($pengaduan->status->nama_status == 'Ditolak')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-red-100 text-red-800 border-red-200">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.detail-pengaduan', $pengaduan->pengaduan_id) }}"
                                   class="text-[#d46a6d] hover:text-[#c55a5d] transition-colors duration-200">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada pengaduan terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
