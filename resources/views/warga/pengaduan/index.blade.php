@extends('layouts.warga.app')
@section('title', 'Pengaduan Saya')

@section('content')
<div class="p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-3xl font-bold text-gray-900">Pengaduan Saya</h1>
                </div>
                <a href="{{ route('warga.pengaduan.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] text-white rounded-lg hover:from-[#c55a5d] hover:to-[#b54a4d] transition-all duration-200 shadow-md hover:shadow-lg font-semibold">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Pengaduan Baru
                </a>
            </div>
            <p class="text-gray-600">Daftar semua pengaduan yang telah Anda buat</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('warga.pengaduan.index') }}" class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan judul atau deskripsi..."
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="md:w-48">
                        <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200">
                            <option value="">Semua Status</option>
                            <option value="Baru" {{ request('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="md:w-48">
                        <select name="kategori" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200">
                            <option value="">Semua Kategori</option>
                            @foreach(\App\Models\Kategori::all() as $kat)
                                <option value="{{ $kat->kategori_id }}" {{ request('kategori') == $kat->kategori_id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-3 bg-[#d46a6d] text-white rounded-lg hover:bg-[#c55a5d] transition-all duration-200">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <a href="{{ route('warga.pengaduan.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pengaduan List -->
        @if($pengaduan->count() > 0)
            <div class="space-y-6">
                @foreach($pengaduan as $item)
                    <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                <div class="flex items-center">
                                                    <i class="fas fa-tag mr-2 text-[#d46a6d]"></i>
                                                    <span>{{ $item->kategori->nama_kategori ?? 'Tidak ada kategori' }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2 text-[#d46a6d]"></i>
                                                    <span class="truncate max-w-xs">{{ Str::limit($item->lokasi, 50) }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-calendar mr-2 text-[#d46a6d]"></i>
                                                    <span>{{ $item->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="ml-4">
                                            @php
                                                $statusColors = [
                                                    'Baru' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'Diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'Selesai' => 'bg-green-100 text-green-800 border-green-200',
                                                    'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                                ];
                                                $statusClass = $statusColors[$item->status->nama_status ?? 'Baru'] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $statusClass }}">
                                                {{ $item->status->nama_status ?? 'Tidak ada status' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($item->deskripsi, 150) }}</p>

                                    <!-- Photo Preview -->
                                    @if($item->foto_bukti)
                                        <div class="mb-4">
                                            <img src="{{ $item->foto_bukti }}"
                                                 alt="Foto bukti"
                                                 class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row gap-3 lg:ml-6 mt-4 lg:mt-0">
                                    <a href="{{ route('warga.pengaduan.detail', $item->pengaduan_id) }}"
                                       class="px-4 py-2 bg-[#d46a6d] text-white rounded-lg hover:bg-[#c55a5d] transition-all duration-200 text-center">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </a>

                                    @if($item->status->nama_status == 'Baru')
                                        <button onclick="confirmDelete({{ $item->id }})"
                                                class="px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-all duration-200 text-center">
                                            <i class="fas fa-trash mr-2"></i>
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $pengaduan->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-6"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Belum Ada Pengaduan</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['search', 'status', 'kategori']))
                            Tidak ada pengaduan yang sesuai dengan filter yang Anda pilih.
                        @else
                            Anda belum membuat pengaduan apapun. Mulai laporkan masalah di lingkungan Anda.
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        @if(request()->hasAny(['search', 'status', 'kategori']))
                            <a href="{{ route('warga.pengaduan.index') }}"
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Reset Filter
                            </a>
                        @endif
                        <a href="{{ route('warga.pengaduan.create') }}"
                           class="px-6 py-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] text-white rounded-lg hover:from-[#c55a5d] hover:to-[#b54a4d] transition-all duration-200 shadow-md hover:shadow-lg font-semibold">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Pengaduan Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md mx-4">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Pengaduan?</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3 justify-center">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Anti-cache
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.href = '{{ route('login') }}';
        }
    });

    function confirmDelete(id) {
        document.getElementById('deleteForm').action = `/warga/pengaduan/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
