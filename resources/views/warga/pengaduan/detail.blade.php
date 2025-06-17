@extends('layouts.warga.app')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="p-8 max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">Detail Pengaduan</h1>
        <p class="text-gray-600">Informasi lengkap dari pengaduan yang Anda ajukan.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Detail Utama -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $pengaduan->judul }}</h2>
                    @php
                        $statusColors = [
                            'Baru' => 'bg-yellow-100 text-yellow-800',
                            'Diproses' => 'bg-blue-100 text-blue-800',
                            'Selesai' => 'bg-green-100 text-green-800',
                            'Ditolak' => 'bg-red-100 text-red-800',
                        ];
                        $statusClass = $statusColors[$pengaduan->status->nama_status ?? 'Baru'] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusClass }}">
                        <i class="fas fa-info-circle mr-1"></i>{{ $pengaduan->status->nama_status }}
                    </span>
                </div>

                <p class="text-gray-700 leading-relaxed mb-4">{{ $pengaduan->deskripsi }}</p>

                @if($pengaduan->foto_bukti)
                <div class="mb-4">
                    <h3 class="text-md font-semibold text-gray-800 mb-2">Foto Bukti</h3>
                    <img src="{{ $pengaduan->foto_bukti }}" class="w-full max-w-md rounded shadow" alt="Foto Bukti">
                </div>
                @endif

                @if($pengaduan->lokasi)
                <div class="mb-4">
                    <h3 class="text-md font-semibold text-gray-800 mb-2">Lokasi</h3>
                    <p>{{ $pengaduan->lokasi }}</p>
                    @if($pengaduan->latitude && $pengaduan->longitude)
                    <p class="text-sm text-gray-500">Koordinat: {{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}</p>
                    @endif
                </div>
                @endif

                @if($pengaduan->latitude && $pengaduan->longitude)
                <div class="mb-4">
                    <h3 class="text-md font-semibold text-gray-800 mb-2">Peta Lokasi</h3>
                    <div id="map" class="w-full h-64 rounded-md shadow border border-gray-300"></div>
                </div>
                @endif

                @if($pengaduan->catatan_admin)
                <div class="bg-blue-50 border border-blue-200 rounded p-4">
                    <h3 class="font-semibold text-blue-800 mb-2">Catatan Admin</h3>
                    <p class="text-blue-700">{{ $pengaduan->catatan_admin }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengaduan</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>Kategori:</strong> {{ $pengaduan->kategori->nama_kategori ?? '-' }}</p>
                    <p><strong>Tanggal Dibuat:</strong> {{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                    <p><strong>Terakhir Diupdate:</strong> {{ $pengaduan->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            @if($pengaduan->tanggapan->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tanggapan Admin</h3>
                <div class="space-y-4">
                    @foreach($pengaduan->tanggapan as $tanggapan)
                        @php
                            $statusMap = [
                                1 => 'Baru',
                                2 => 'Diproses',
                                3 => 'Selesai',
                                4 => 'Ditolak'
                            ];
                            $status = $statusMap[$tanggapan->status_baru] ?? '-';
                        @endphp
                        <div class="border rounded p-4 bg-gray-50">
                            <p class="mb-2 text-gray-800">{{ $tanggapan->isi_tanggapan }}</p>
                            @if($tanggapan->foto_tanggapan)
                                <img src="{{ asset('storage/' . $tanggapan->foto_tanggapan) }}" alt="Foto Tanggapan" class="rounded shadow max-h-40 mb-2">
                            @endif
                            <p class="text-sm text-gray-500">Status: <strong>{{ $status }}</strong></p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@if($pengaduan->latitude && $pengaduan->longitude)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>'
        }).addTo(map);
        L.marker([{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}])
            .addTo(map)
            .bindPopup("Lokasi Pengaduan")
            .openPopup();
    });
</script>
@endif
@endsection
