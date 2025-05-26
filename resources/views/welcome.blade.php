<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'LaporAja - Beranda')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-primary-600">LaporAja</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Laporkan Masalah</span>
                            <span class="block text-primary-600 xl:inline">Infrastruktur & Layanan Publik</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Platform digital untuk menyampaikan pengaduan dan aspirasi terkait infrastruktur dan layanan publik di Kabupaten Jember. Bersama kita wujudkan pelayanan publik yang lebih baik.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    Mulai Lapor
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 md:py-4 md:text-lg md:px-10 transition duration-200">
                                    Pelajari Lebih Lanjut
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div class="h-56 w-full bg-gradient-to-r from-primary-400 to-primary-600 sm:h-72 md:h-96 lg:w-full lg:h-full flex items-center justify-center">
                <i class="fas fa-megaphone text-white text-8xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-12 bg-white">
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

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
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

                    <div class="relative">
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

                    <div class="relative">
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

                    <div class="relative">
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

    <!-- CTA Section -->
    <div class="bg-primary-600">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Siap untuk melaporkan?</span>
                <span class="block">Mulai sekarang juga.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-primary-200">
                Bergabunglah dengan ribuan warga Jember lainnya yang telah mempercayai LaporAja untuk menyampaikan aspirasi mereka.
            </p>
            <a href="{{ route('register') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 sm:w-auto transition duration-200">
                Daftar Gratis
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <p class="text-center text-sm text-gray-500">
                    &copy; 2025 LaporAja. Dikembangkan untuk Kabupaten Jember.
                </p>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">
                    Sistem Informasi Pengaduan Infrastruktur dan Layanan Publik
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection
