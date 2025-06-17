@extends('layouts.admin.app')
@section('title', 'Export Data Pengaduan')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Export Data Pengaduan</h1>
                <p class="text-gray-600">Download data pengaduan dalam format Excel atau PDF</p>
            </div>
            <a href="{{ route('admin.statistik') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">
                <i class="fas fa-chart-bar mr-2"></i>Kembali ke Statistik
            </a>
        </div>
    </div>

    <!-- Form Export -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('admin.export.download') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Rentang Tanggal -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Rentang Tanggal</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Filter -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="kategori_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->status_id }}">{{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Format Export -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Format Export</h3>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="format" value="excel" class="form-radio h-5 w-5 text-blue-600" checked>
                        <span class="ml-2 text-gray-700">Excel (.xlsx)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="format" value="pdf" class="form-radio h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">PDF (.pdf)</span>
                    </label>
                </div>
            </div>

            <!-- Preview Data -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data yang akan diexport</h3>
                <div class="bg-gray-50 p-4 rounded-md">
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>ID Pengaduan</li>
                        <li>Judul Pengaduan</li>
                        <li>Deskripsi</li>
                        <li>Kategori</li>
                        <li>Nama Pelapor</li>
                        <li>Lokasi</li>
                        <li>Status</li>
                        <li>Tanggal Dibuat</li>
                        <li>Tanggal Diupdate</li>
                    </ul>
                </div>
            </div>

            <!-- Tombol Export -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-download mr-2"></i>Download Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
