@extends('layouts.admin.app')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="p-8">
        <div class="mb-6">
            <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Pengaduan</h1>
            <p class="text-gray-600">Informasi lengkap pengaduan warga</p>
        </div>

        <div class="flex space-x-3">
            @if(!in_array($pengaduan->status->nama_status, ['Ditolak', 'Selesai']))
                <a href="{{ route('admin.tanggapan.create', $pengaduan->pengaduan_id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">
                    <i class="fas fa-comment-dots mr-2"></i>Tambah Tanggapan
                </a>
            @endif

            <a href="{{ route('admin.kelola-pengaduan') }}"
            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Detail Pengaduan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $pengaduan->judul }}</h2>
                        @if($pengaduan->status->nama_status == 'Baru')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Baru
                            </span>
                        @elseif($pengaduan->status->nama_status == 'Diproses')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-cog mr-1"></i>Diproses
                            </span>
                        @elseif($pengaduan->status->nama_status == 'Selesai')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Selesai
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @endif
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $pengaduan->deskripsi }}</p>
                    </div>
                </div>

                <!-- Foto Pengaduan -->
                @if($pengaduan->foto_bukti)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Foto Pengaduan</h3>
                        <img src="{{ $pengaduan->foto_bukti }}"
                             alt="Foto Pengaduan"
                             class="w-full max-w-md rounded-lg shadow-sm">
                    </div>
                @endif

                <!-- Lokasi -->
                @if($pengaduan->lokasi)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Lokasi</h3>
                        <p class="text-gray-700 mb-2">{{ $pengaduan->lokasi }}</p>
                        @if($pengaduan->latitude && $pengaduan->longitude)
                            <p class="text-sm text-gray-500">
                                Koordinat: {{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}
                            </p>
                        @endif
                    </div>
                @endif

                @if($pengaduan->latitude && $pengaduan->longitude)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Peta Lokasi</h3>
                    <div id="map" class="w-full h-64 rounded-md shadow border border-gray-300"></div>
                </div>
                @endif

                <!-- Catatan Admin -->
                @if($pengaduan->catatan_admin)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Catatan Admin</h3>
                        <p class="text-blue-800">{{ $pengaduan->catatan_admin }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Info Pelapor -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelapor</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Nama</p>
                        <p class="text-gray-900">{{ $pengaduan->warga->nama ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Email</p>
                        <p class="text-gray-900">{{ $pengaduan->warga->email ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Telepon</p>
                        <p class="text-gray-900">{{ $pengaduan->warga->no_hp ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Pengaduan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengaduan</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Kategori</p>
                        <p class="text-gray-900">{{ $pengaduan->kategori->nama_kategori }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tanggal Dibuat</p>
                        <p class="text-gray-900">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Terakhir Diupdate</p>
                        <p class="text-gray-900">{{ $pengaduan->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Tanggapan -->
            @if($pengaduan->tanggapan && $pengaduan->tanggapan->count() > 0)
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

                            $namaStatus = $statusMap[$tanggapan->status_baru] ?? 'Tidak Diketahui';
                        @endphp
                            <div class="border rounded-md p-4 bg-gray-50 cursor-pointer hover:bg-gray-100" onclick="bukaModalTanggapan(`{{ $tanggapan->isi_tanggapan }}`, '{{ $namaStatus }}', '{{ $tanggapan->foto_tanggapan ?? '' }}')">
                                <div class="flex items-start justify-between">
                                    <p class="text-gray-800">{{ $tanggapan->isi_tanggapan }}</p>
                                    <span class="inline-block px-2 py-1 text-xs rounded-md font-semibold
                                        @if($namaStatus == 'Baru') bg-yellow-100 text-yellow-800
                                        @elseif($namaStatus == 'Diproses') bg-blue-100 text-blue-800
                                        @elseif($namaStatus == 'Selesai') bg-green-100 text-green-800
                                        @elseif($namaStatus == 'Ditolak') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $namaStatus }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Dibuat pada: {{ \Carbon\Carbon::parse($tanggapan->created_at)->format('d M Y, H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

<!-- Modal Detail Tanggapan -->
<div id="modalDetailTanggapan" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-[1000]">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Tanggapan</h3>

        <div class="space-y-3">
            <div>
                <p class="text-sm text-gray-600 font-medium">Isi Tanggapan:</p>
                <p id="modalIsiTanggapan" class="text-gray-900"></p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-medium">Status:</p>
                <p id="modalStatusTanggapan" class="font-semibold"></p>
            </div>
            <div id="modalFotoTanggapanContainer" class="hidden">
                <p class="text-sm text-gray-600 font-medium">Foto Tanggapan:</p>
                <img id="modalFotoTanggapan" src="" alt="Foto Tanggapan" class="rounded-md shadow-md max-h-64 mt-1">
            </div>
        </div>

        <button onclick="tutupModalTanggapan()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl">
            &times;
        </button>
    </div>
</div>


<!-- Modal Update Status -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status Pengaduan</h3>
            <form id="statusForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="statusSelect"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Baru">Baru</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin (Opsional)</label>
                    <textarea name="catatan_admin" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tambahkan catatan untuk warga...">{{ $pengaduan->catatan_admin }}</textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($pengaduan->latitude && $pengaduan->longitude)
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.href = '{{ route('login') }}';
        }
    });

    function openStatusModal(id, currentStatus) {
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusForm').action = `{{ url('/admin/pengaduan') }}/${id}/update-status`;
        document.getElementById('statusSelect').value = currentStatus;
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('statusModal');
        if (event.target == modal) {
            closeStatusModal();
        }
    }
     document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}]).addTo(map)
            .bindPopup("Lokasi Pengaduan")
            .openPopup();
    });

    function bukaModalTanggapan(isi, status, foto) {
        document.getElementById('modalDetailTanggapan').classList.remove('hidden');
        document.getElementById('modalIsiTanggapan').textContent = isi;
        document.getElementById('modalStatusTanggapan').textContent = status;

        const fotoContainer = document.getElementById('modalFotoTanggapanContainer');
        const fotoEl = document.getElementById('modalFotoTanggapan');

        if (foto && foto.trim() !== '') {
            fotoEl.src = foto.startsWith('http') ? foto : `{{ asset('storage') }}/${foto}`;
            fotoContainer.classList.remove('hidden');
        } else {
            fotoContainer.classList.add('hidden');
            fotoEl.src = '';
        }
    }

    function tutupModalTanggapan() {
        document.getElementById('modalDetailTanggapan').classList.add('hidden');
    }
</script>
@endif
@endsection
