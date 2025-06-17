<style>
    /* Sidebar Menu */
    nav a {
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    nav a:hover {
        background-color: #f5e6d3;
        color: #d46a6d;
        transform: translateX(6px); /* Geser ke kanan saat hover */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan halus */
    }

    nav a:hover i {
        color: #d46a6d;
        transform: scale(1.15) rotate(5deg); /* Membesar dan rotasi ikon */
        transition: transform 0.3s ease-in-out;
    }

    nav a.active {
        background: linear-gradient(to right, #d46a6d, #c55a5d); /* Gradien seperti header */
        color: white;
        transform: translateX(3px); /* Geser sedikit untuk menandakan aktif */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    nav a.active i {
        color: white;
        transform: scale(1.1); /* Ikon sedikit membesar */
    }

    nav a.active:hover {
        transform: translateX(3px); /* Tetap di posisi aktif saat hover */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
    }

    /* Indikator Aktif (Garis di kiri) */
    nav a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background-color: #ffffff;
        opacity: 0.8;
    }

    /* Logout Button */
    form button[type="submit"] {
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    form button[type="submit"]:hover {
        background-color: #fef2f2; /* Merah muda lembut */
        color: #b91c1c; /* Merah lebih tua */
        transform: translateX(6px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    form button[type="submit"]:hover i {
        transform: rotate(15deg); /* Rotasi ikon logout */
        color: #b91c1c;
    }
</style>

<div class="w-64 bg-white shadow-lg min-h-screen border-r border-[#d46a6d]/20" id="sidebar">
    <!-- Logo/Header -->
    <div class="p-6 border-b border-[#d46a6d]/20 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d]">
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/laporaja-logo.png') }}" alt="LaporAja!" class="h-12 w-auto object-contain drop-shadow-md">
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-6">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.kelola-pengaduan') }}"
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.kelola-pengaduan') || request()->routeIs('admin.detail-pengaduan') ? 'active' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                <i class="fas fa-exclamation-triangle w-5 h-5 mr-3"></i>
                Kelola Pengaduan
            </a>
        </div>

        <!-- Laporan & Analisis Section -->
        <div class="mt-8 px-4">
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Laporan & Analisis</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.statistik') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.statistik') ? 'active' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    Statistik
                </a>

                <a href="{{ route('admin.export') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.export') ? 'active' : 'text-gray-700 hover:bg-[#f5e6d3] hover:text-[#d46a6d]' }}">
                    <i class="fas fa-download w-5 h-5 mr-3"></i>
                    Export Data
                </a>
            </div>
        </div>

        <!-- User Section -->
        <div class="mt-8 pt-6 border-t border-[#d46a6d]/20">
            <div class="px-4">
                <div class="flex items-center p-3 bg-[#f5e6d3] rounded-lg">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white text-sm font-bold">{{ substr(Auth::guard('admin')->user()->nama, 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('admin')->user()->nama }}</p>
                        <p class="text-xs text-gray-600">Administrator</p>
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
