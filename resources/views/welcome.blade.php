<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'LaporAja - Beranda')

@push('styles')
<style>
    /* Hero Section Styles */
    .hero-gradient {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 50%, #c7d2fe 100%);
    }

    .gradient-text {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* Card Styles */
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .emergency-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
    }

    .emergency-card:hover {
        transform: translateY(-4px);
        border-left-color: #dc2626;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 1);
    }

    .report-card {
        transition: all 0.3s ease;
    }
    .report-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Filter and Status Styles */
    .filter-btn {
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background-color: #2563eb;
        color: white;
        transform: scale(1.05);
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-progress { background-color: #dbeafe; color: #1e40af; }
    .status-completed { background-color: #d1fae5; color: #065f46; }
    .status-rejected { background-color: #fee2e2; color: #991b1b; }

    /* Animation Styles */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .slide-in-left {
        animation: slideInLeft 0.8s ease-out;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .slide-in-right {
        animation: slideInRight 0.8s ease-out;
    }

    /* Button Hover Effects */
    .btn-primary {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .hero-mobile-image {
            display: block;
            margin: 2rem auto;
            max-width: 300px;
            height: auto;
        }
    }

    @media (max-width: 640px) {
        .emergency-card {
            text-align: center;
        }

        .emergency-card .flex {
            flex-direction: column;
            align-items: center;
        }

        .emergency-card .ml-4 {
            margin-left: 0;
            margin-top: 1rem;
        }

        .gradient-text {
            font-size: 2.5rem;
            line-height: 1.1;
        }
    }

    /* Mobile menu toggle */
    .mobile-menu {
        display: none;
    }

    @media (max-width: 768px) {
        .mobile-menu.active {
            display: block;
        }
    }

    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        z-index: 9999;
        transition: width 0.1s ease;
    }

    /* Loading Animation */
    .loading-dots {
        display: inline-block;
    }

    .loading-dots::after {
        content: '';
        animation: dots 1.5s infinite;
    }

    @keyframes dots {
        0%, 20% { content: ''; }
        40% { content: '.'; }
        60% { content: '..'; }
        80%, 100% { content: '...'; }
    }
</style>
@endpush

@section('content')
<div id="welcome" class="min-h-screen">
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-primary-600">LaporAja!</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="#home" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Beranda</a>
                            <a href="#features" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Fitur</a>
                            <a href="#emergency" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Darurat</a>
                            <a href="#reports" class="nav-link text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="hidden md:flex text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200 items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="hidden md:flex bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 items-center btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar
                    </a>
                    <!-- Mobile menu button -->
                    <button class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu md:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                    <a href="#home" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">Beranda</a>
                    <a href="#features" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">Fitur</a>
                    <a href="#emergency" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">Darurat</a>
                    <a href="#reports" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">Laporan</a>
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-md mt-2">
                            <i class="fas fa-user-plus mr-2"></i>Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<!-- Hero Section -->
    <div id="home" class="hero-gradient min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 floating-animation"></div>
        <div class="absolute bottom-32 left-20 w-24 h-24 bg-indigo-200 rounded-full opacity-30 floating-animation" style="animation-delay: -2s;"></div>
        <div class="absolute top-40 right-20 w-28 h-28 bg-purple-200 rounded-full opacity-25 floating-animation" style="animation-delay: -4s;"></div>

        <div class="max-w-7xl mx-auto min-h-screen lg:grid lg:grid-cols-2 lg:items-center lg:gap-8 relative z-10">
            <!-- KIRI: TEKS -->
            <div class="lg:col-span-1 px-6 py-12 lg:px-8 slide-in-left">
                <main class="mx-auto sm:mt-12 md:mt-16 lg:mt-0">
                    <div class="sm:text-center lg:text-left">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-primary-100 text-primary-800 mb-6">
                            <i class="fas fa-star mr-2"></i>
                            Platform Pengaduan Terpercaya
                        </div>

                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Laporkan Masalah</span>
                            <span class="block gradient-text">Infrastruktur & Layanan Publik</span>
                        </h1>

                        <p class="mt-6 text-lg text-gray-600 sm:text-xl leading-relaxed">
                            Platform digital untuk menyampaikan pengaduan dan aspirasi terkait infrastruktur dan layanan publik di <span class="font-semibold text-primary-600">Kabupaten Jember</span>. Bersama kita wujudkan pelayanan publik yang lebih baik.
                        </p>

                        <!-- Stats -->
                        <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary-600 counter" data-target="1000">0</div>
                                <div class="text-sm text-gray-500">Laporan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 counter" data-target="85">0</div>
                                <div class="text-sm text-gray-500">% Terselesaikan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">24/7</div>
                                <div class="text-sm text-gray-500">Layanan</div>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col sm:flex-row sm:justify-center lg:justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('register') }}" class="group inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 transition duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl btn-primary">
                                <i class="fas fa-paper-plane mr-3 group-hover:translate-x-1 transition-transform"></i>
                                Mulai Lapor Sekarang
                            </a>
                        </div>
                    </div>
                </main>
            </div>

            <!-- KANAN: GAMBAR - PRESISI SESUAI GAMBAR -->
            <div class="lg:col-span-1 relative flex justify-center lg:justify-end items-center h-full slide-in-right">
                <div class="relative w-full max-w-lg lg:max-w-full h-[500px] lg:h-[600px]">
                    <img
                        src="{{ asset('img/LaporAja-bg.png') }}"
                        alt="Hero LaporAja - Platform Pengaduan Kabupaten Jember"
                        class="w-full h-full object-contain drop-shadow-2xl"
                    >
                </div>
            </div>

            <!-- Mobile Image - Hanya tampil di mobile -->
            <div class="lg:hidden px-6 pb-8">
                <img
                    src="{{ asset('img/LaporAja-bg.png') }}"
                    alt="Hero LaporAja"
                    class="w-full max-w-sm mx-auto drop-shadow-xl"
                >
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary-600 font-semibold tracking-wide uppercase">Fitur Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Layanan Pengaduan yang Mudah dan Transparan
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Dengan berbagai fitur canggih, kami memastikan setiap pengaduan Anda ditangani dengan baik.
                </p>
            </div>

            <div class="mt-16">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative card-hover bg-white p-6 rounded-xl shadow-md">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Lapor 24/7</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Laporkan masalah kapan saja, dimana saja. Sistem kami tersedia 24 jam sehari, 7 hari seminggu.
                        </dd>
                    </div>

                    <div class="relative card-hover bg-white p-6 rounded-xl shadow-md">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                <i class="fas fa-eye text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Transparansi Penuh</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Pantau perkembangan pengaduan Anda secara real-time dengan sistem notifikasi yang transparan.
                        </dd>
                    </div>

                    <div class="relative card-hover bg-white p-6 rounded-xl shadow-md">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Berbasis Lokasi</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Setiap pengaduan dilengkapi dengan informasi lokasi yang akurat untuk penanganan yang tepat sasaran.
                        </dd>
                    </div>

                    <div class="relative card-hover bg-white p-6 rounded-xl shadow-md">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                                <i class="fas fa-shield-alt text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Data Aman</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Keamanan data pribadi dan pengaduan Anda adalah prioritas utama dengan enkripsi tingkat tinggi.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Emergency Numbers Section -->
    <div id="emergency" class="py-16 bg-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    Nomor Darurat Kabupaten Jember
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Hubungi nomor-nomor berikut untuk situasi darurat dan layanan penting
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <!-- Layanan Kedaruratan -->
                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-ambulance text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Ambulance Dinkes</h3>
                            <p class="text-red-600 font-bold text-xl">0331-425222</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-fire-extinguisher text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pemadam Kebakaran</h3>
                            <p class="text-red-600 font-bold text-xl">0331-321213</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-shield-alt text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Polres Jember</h3>
                            <p class="text-red-600 font-bold text-xl">0331-484285</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-mountain text-2xl text-orange-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">BPBD Jember</h3>
                            <p class="text-red-600 font-bold text-xl">0331-322965</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-plus text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">PMI Jember</h3>
                            <p class="text-red-600 font-bold text-xl">0331-484383</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-life-ring text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">BASARNAS</h3>
                            <p class="text-red-600 font-bold text-xl">0331-540811</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-road text-2xl text-gray-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Hotline Jalan</h3>
                            <p class="text-red-600 font-bold text-xl">0811-336-006</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-tint text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">PDAM Jember</h3>
                            <p class="text-red-600 font-bold text-xl">0331-482-700</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports History Section -->
    <div id="reports" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    <i class="fas fa-history text-primary-600 mr-3"></i>
                    Riwayat Laporan Terbaru
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Lihat laporan-laporan yang telah disubmit oleh warga Kabupaten Jember
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="mt-8 flex flex-wrap justify-center gap-2">
                <button class="filter-btn active px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="all">
                    <i class="fas fa-list mr-2"></i> Semua
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="infrastruktur">
                    <i class="fas fa-road mr-2"></i> Infrastruktur
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="layanan-publik">
                    <i class="fas fa-users mr-2"></i> Layanan Publik
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="lingkungan">
                    <i class="fas fa-leaf mr-2"></i> Lingkungan
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="keamanan">
                    <i class="fas fa-shield-alt mr-2"></i> Keamanan
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="kesehatan">
                    <i class="fas fa-heartbeat mr-2"></i> Kesehatan
                </button>
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-primary-600 hover:text-white transition duration-200" data-filter="pendidikan">
                    <i class="fas fa-graduation-cap mr-2"></i> Pendidikan
                </button>
            </div>

            @foreach ($laporanSelesai as $laporan)
                <div class="report-card bg-white rounded-lg shadow-md p-6" data-category="{{ strtolower(str_replace(' ', '-', $laporan->kategori->nama_kategori ?? 'lainnya')) }}">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-green-600 text-xl mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $laporan->judul }}</h3>
                        </div>
                        <span class="status-badge status-completed">{{ $laporan->status->nama_status }}</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit($laporan->deskripsi, 100) }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $laporan->lokasi }}</span>
                        <span class="mx-2">•</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <div class="flex space-x-6">
                    <a href="#home" class="text-gray-400 hover:text-gray-500 transition duration-200">
                        <span class="sr-only">Beranda</span>
                        <i class="fas fa-home"></i>
                    </a>
                    <a href="#features" class="text-gray-400 hover:text-gray-500 transition duration-200">
                        <span class="sr-only">Fitur</span>
                        <i class="fas fa-cog"></i>
                    </a>
                    <a href="#emergency" class="text-gray-400 hover:text-gray-500 transition duration-200">
                        <span class="sr-only">Darurat</span>
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="#reports" class="text-gray-400 hover:text-gray-500 transition duration-200">
                        <span class="sr-only">Laporan</span>
                        <i class="fas fa-file-alt"></i>
                    </a>
                </div>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <div class="flex flex-col items-center">
                    <p class="text-center text-base text-gray-400 mb-2">
                        Sistem Informasi Pengaduan Infrastruktur dan Layanan Publik
                    </p>
                    <p class="text-center text-sm text-gray-500">
                        &copy; 2025 LaporAja. Dikembangkan untuk Kabupaten Jember.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    }

    // Scroll progress bar
    const scrollProgress = document.getElementById('scrollProgress');
    if (scrollProgress) {
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });
    }

    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;

        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    };

    // Intersection Observer for counter animation
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

    // Filter functionality for reports
    const filterButtons = document.querySelectorAll('.filter-btn');
    const reportCards = document.querySelectorAll('.report-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            reportCards.forEach(card => {
                if (filterValue === 'all') {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    if (card.getAttribute('data-category') === filterValue) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease-in-out';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Close mobile menu if open
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                }
            }
        });
    });

    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.emergency-card, .report-card, .card-hover').forEach(el => {
        observer.observe(el);
    });

    // Add loading effect to buttons
    document.querySelectorAll('.btn-primary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!this.href || this.href.includes('#')) return;

            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading<span class="loading-dots"></span>';
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        });
    });
});
</script>
@endsection
