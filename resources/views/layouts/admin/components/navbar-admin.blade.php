<div class="bg-white shadow-sm border-b border-[#d46a6d]/20">
    <div class="px-8 py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="text-gray-600">Kelola sistem pengaduan <span class="font-semibold text-[#d46a6d]">LaporAja!</span> dengan mudah</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Notifikasi -->
                <div class="relative group">
                <button class="relative p-3 text-gray-500 hover:text-[#d46a6d] hover:bg-[#f5e6d3] rounded-lg transition-all duration-200">
                    <i class="fas fa-bell text-lg"></i>
                    @if(isset($notifikasi_count) && $notifikasi_count > 0)
                        <span class="absolute -top-1 -right-1 bg-[#d46a6d] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">
                            {{ $notifikasi_count }}
                        </span>
                    @endif
                </button>

                <!-- Dropdown Box -->
                <div class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg hidden group-hover:block z-50">
                    <div class="p-4 border-b font-semibold text-gray-700">Notifikasi</div>
                    <ul class="max-h-60 overflow-y-auto">
                        @isset($notifikasi)
                            @forelse($notifikasi as $notif)
                                <li class="px-4 py-2 text-sm text-gray-700 border-b">
                                    <strong>Status:</strong> {{ ucfirst($notif->status) }}<br>
                                    <span class="text-gray-500">{{ Str::limit($notif->isi_pengaduan, 50) }}</span>
                                </li>
                            @empty
                                <li class="px-4 py-2 text-sm text-gray-500 text-center">Belum ada notifikasi</li>
                            @endforelse
                        @else
                            <li class="px-4 py-2 text-sm text-gray-500 text-center">Belum ada notifikasi</li>
                        @endisset
                    </ul>
                    <div class="p-2 text-right">
                        <a href="#" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
                    </div>
                </div>
            </div>

                <script>
                function toggleDropdown() {
                    const dropdown = document.getElementById('notifDropdown');
                    dropdown.classList.toggle('hidden');
                }

                // Optional: Klik di luar dropdown untuk menutup
                window.addEventListener('click', function (e) {
                    const dropdown = document.getElementById('notifDropdown');
                    if (!e.target.closest('#notifDropdown') && !e.target.closest('button')) {
                        dropdown.classList.add('hidden');
                    }
                });
            </script>

                <!-- Profile Dropdown p-->
                <div class="relative">
                    <a href="{{ route('admin.profil') }}"
                        class="flex items-center space-x-2 p-2 rounded-lg hover:bg-[#f5e6d3] transition-all duration-200">
                    <div class="w-8 h-8 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ substr(Auth::guard('admin')->user()->nama, 0, 1) }}
                        </span>
                    </div>
                        <span class="text-gray-700 font-medium">
                        {{ Auth::guard('admin')->user()->nama }}
                        </span>
                        <i class="fas text-gray-400 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
