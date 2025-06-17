<div class="w-64 bg-white shadow-lg min-h-screen border-r border-[#d46a6d]/20">
    <!-- Logo/Header -->
    <div class="p-6 border-b border-[#d46a6d]/20 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d]">
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/laporaja-logo.png') }}" alt="LaporAja!" class="h-12 w-auto object-contain drop-shadow-md">
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-6">
        <div class="px-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('warga.dashboard') }}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('warga.dashboard') ? 'text-white bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] shadow-md' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                Dashboard
            </a>

            <!-- Pengaduan Saya -->
            <a href="{{ route('warga.pengaduan.index') }}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('warga.pengaduan.index') ? 'text-white bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] shadow-md' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                Pengaduan Saya
            </a>

            <!-- Buat Pengaduan -->
            <a href="{{ route('warga.pengaduan.create') }}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('warga.pengaduan.create') ? 'text-white bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] shadow-md' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                <i class="fas fa-plus-circle w-5 h-5 mr-3"></i>
                Buat Pengaduan
            </a>

            <!-- Laporan (Placeholder) -->
            <a href="{{route('warga.laporan')}}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]">
                <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                Laporan
            </a>
        </div>

        <!-- User Section -->
        <div class="mt-8 pt-6 border-t border-[#d46a6d]/20">
            <div class="px-4">
                <div class="flex items-center p-3 bg-[#f5e6d3] rounded-lg">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white text-sm font-bold">{{ substr(Auth::guard('warga')->user()->nama, 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('warga')->user()->nama }}</p>
                        <p class="text-xs text-gray-600">Warga</p>
                    </div>
                </div>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logoutButton"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium text-[#d46a6d] hover:bg-red-50 hover:text-red-700 rounded-lg transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
