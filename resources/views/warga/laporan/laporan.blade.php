@extends('layouts.warga.app')
@section('title', 'Laporan Pengaduan Selesai')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Laporan Pengaduan</h1>
        <p class="text-gray-600">Menampilkan pengaduan yang telah diselesaikan</p>
    </div>

    @if($pengaduan->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($pengaduan as $item)
                <a href="{{route('warga.detaillaporan', $item->pengaduan_id)}}">
                    <div class="bg-white rounded-lg shadow p-4">
                        <!-- Gambar -->
                        @if($item->foto)
                            <img src="{{ $pengaduan->foto_bukti }}" alt="Foto Pengaduan" class="w-full h-48 object-cover rounded-md mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-md mb-4">
                                Tidak ada foto
                            </div>
                        @endif

                        <!-- Judul -->
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->judul }}</h2>

                        <!-- Info tambahan (opsional) -->
                        <p class="text-sm text-gray-600 mb-1">Pelapor: {{ $item->warga->name ?? 'Tidak diketahui' }}</p>
                        <p class="text-sm text-gray-600">Tanggal: {{ $item->created_at->format('d/m/Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 mt-10">
            Tidak ada pengaduan dengan status selesai.
        </div>
    @endif
</div>
@endsection
