@extends('layouts.admin.app')
@section('title', 'Kelola Pengaduan')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Pengaduan</h1>
        <p class="text-gray-600">Kelola dan pantau semua pengaduan warga</p>
    </div>

    <!-- Filter dan Search -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('admin.kelola-pengaduan') }}"
              class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengaduan</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari berdasarkan judul atau nama..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Filter Status -->
            <div class="md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Baru" {{ request('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <!-- Filter Kategori -->
            <div class="md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="kategori"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->kategori_id }}"
                               {{ request('kategori') == $item->kategori_id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Button Filter -->
            <div class="flex items-end">
                <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Pengaduan -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Pengaduan</h3>
        </div>

        @if($pengaduan->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pengaduan as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $pengaduan->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ Str::limit($item->judul, 40) }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($item->deskripsi, 60) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->warga->name ?? 'Tidak tersedia' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->kategori->nama_kategori ?? 'Tidak tersedia' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->status->nama_status == 'Baru')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Baru
                                        </span>
                                    @elseif($item->status->nama_status == 'Diproses')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <i class="fas fa-cog mr-1"></i>Diproses
                                        </span>
                                    @elseif($item->status->nama_status == 'Selesai')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                        </span>
                                    @elseif($item->status->nama_status == 'Ditolak')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.detail-pengaduan', $item->pengaduan_id) }}"
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button onclick="openStatusModal({{ $item->pengaduan_id }})"
                                                class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4">
                {{ $pengaduan->appends(request()->query())->links() }}
            </div>
        @else
            <div class="px-6 py-4 text-center text-gray-500">
                Tidak ada pengaduan ditemukan.
            </div>
        @endif
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
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Baru">Baru</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeStatusModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                    </div>
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

    function openStatusModal(pengaduan_id) {
        document.getElementById('statusForm').action = '{{ route('admin.update-status', ':pengaduan_id') }}'.replace(':pengaduan_id', pengaduan_id);
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusForm').reset();
    }
</script>
@endsection
