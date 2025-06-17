@extends('layouts.warga.app')
@section('title', 'Buat Pengaduan Baru')

@section('content')
<div class="p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <h1 class="text-3xl font-bold text-gray-900">Buat Pengaduan Baru</h1>
            </div>
            <p class="text-gray-600">Laporkan keluhan atau masalah yang Anda temui di lingkungan sekitar</p>
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

        <!-- Form -->
        <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
            @csrf

            <div class="bg-white rounded-xl shadow-md border border-[#d46a6d]/10 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-[#f5e6d3] to-white border-b border-[#d46a6d]/10">
                    <h3 class="text-lg font-bold text-gray-900">Informasi Pengaduan</h3>
                    <p class="text-sm text-gray-600">Isi form di bawah dengan lengkap dan jelas</p>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_id" id="kategori_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200 @error('kategori_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id }}" {{ old('kategori_id') == $item->kategori_id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                               placeholder="Contoh: Jalan Berlubang di RT 05"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200 @error('judul') border-red-500 @enderror">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="5"
                                  placeholder="Jelaskan detail masalah yang Anda temui..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi dengan Map -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Lokasi Kejadian <span class="text-red-500">*</span>
                        </label>

                        <!-- Input Alamat dengan Search -->
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                                       placeholder="Ketik alamat atau klik pada peta untuk menandai lokasi"
                                       class="w-full px-4 py-3 pr-24 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#d46a6d] focus:border-[#d46a6d] transition-all duration-200 @error('lokasi') border-red-500 @enderror">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex space-x-2">
                                    <button type="button" id="searchAddressBtn"
                                            class="text-[#d46a6d] hover:text-[#c55a5d] transition-colors duration-200"
                                            title="Cari alamat">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button type="button" id="getLocationBtn"
                                            class="text-[#d46a6d] hover:text-[#c55a5d] transition-colors duration-200"
                                            title="Gunakan lokasi saat ini">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Ketik alamat lalu klik ikon pencarian, atau klik ikon lokasi untuk GPS, atau klik langsung pada peta
                            </p>
                        </div>

                        <!-- Map Container -->
                        <div class="border border-gray-300 rounded-lg overflow-hidden mb-4">
                            <div id="map" class="w-full h-80 bg-gray-100"></div>
                        </div>

                        <!-- Koordinat Display -->
                        <div id="coordinateDisplay" class="hidden p-3 bg-[#f5e6d3] rounded-lg border border-[#d46a6d]/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Koordinat Terpilih:</p>
                                    <p class="text-xs text-gray-600" id="coordinateText">-</p>
                                </div>
                                <i class="fas fa-map-pin text-[#d46a6d]"></i>
                            </div>
                        </div>

                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        @error('latitude')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        @error('longitude')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden inputs for coordinates -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <!-- Foto Bukti -->
                    <div>
                        <label for="foto_bukti" class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Bukti <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#d46a6d] transition-colors duration-200">
                            <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <div id="uploadArea" class="cursor-pointer" onclick="document.getElementById('foto_bukti').click()">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 mb-2">Klik untuk upload foto bukti</p>
                                <p class="text-xs text-gray-500">Format: JPG, PNG (Maksimal 2MB)</p>
                            </div>
                            <div id="imagePreview" class="hidden">
                                <img id="preview" src="/placeholder.svg" alt="Preview" class="max-w-full h-48 object-cover rounded-lg mx-auto">
                                <p class="mt-2 text-sm text-gray-600">Klik untuk mengganti foto</p>
                            </div>
                        </div>
                        @error('foto_bukti')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('warga.dashboard') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" id="submitBtn"
                                class="px-8 py-3 bg-gradient-to-r from-[#d46a6d] to-[#c55a5d] text-white rounded-lg hover:from-[#c55a5d] hover:to-[#b54a4d] transition-all duration-200 shadow-md hover:shadow-lg font-semibold">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pengaduan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Anti-cache -->
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.href = '{{ route('login') }}';
        }
    });
</script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
// ... (Leaflet script remains the same as provided)
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map
    let map = L.map('map').setView([-8.1689, 113.7006], 13); // Default to Jember, Jawa Timur
    let marker = null;

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Function to set marker and update form
    function setMarkerAndUpdate(lat, lng, address = null) {
        // Remove existing marker
        if (marker) {
            map.removeLayer(marker);
        }

        // Add new marker
        marker = L.marker([lat, lng]).addTo(map);

        // Update form fields
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // Update coordinate display
        document.getElementById('coordinateText').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        document.getElementById('coordinateDisplay').classList.remove('hidden');

        // Update address if provided
        if (address) {
            document.getElementById('lokasi').value = address;
        } else {
            // Get address using reverse geocoding
            reverseGeocode(lat, lng);
        }
    }

    // Reverse geocoding to get address
    async function reverseGeocode(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=id`);
            const data = await response.json();
            const address = data.display_name || `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            document.getElementById('lokasi').value = address;
        } catch (error) {
            console.error('Error getting address:', error);
            document.getElementById('lokasi').value = `Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        }
    }

    // Forward geocoding (search address) - Multiple providers for better results
    async function searchAddress(address) {
        try {
            // Try multiple search strategies
            const searchQueries = [
                address, // Original query
                address + ', Indonesia', // Add country
                address.replace(/No\.\s*\d+/i, ''), // Remove house number
                address.split(',')[0] + ', ' + address.split(',').slice(-2).join(',') // Street + City + Province
            ];

            for (let query of searchQueries) {
                console.log('Searching for:', query);

                // Try Nominatim with different parameters
                const nominatimUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=id&addressdetails=1&accept-language=id`;
                const response = await fetch(nominatimUrl);
                const data = await response.json();

                if (data.length > 0) {
                    // Find best match (prefer results with higher importance or more specific)
                    let bestResult = data[0];
                    for (let result of data) {
                        if (result.importance > bestResult.importance ||
                            (result.address && result.address.road)) {
                            bestResult = result;
                        }
                    }

                    const lat = parseFloat(bestResult.lat);
                    const lng = parseFloat(bestResult.lon);

                    map.setView([lat, lng], 16);
                    setMarkerAndUpdate(lat, lng, bestResult.display_name);
                    return true;
                }
            }

            return false;
        } catch (error) {
            console.error('Error searching address:', error);
            return false;
        }
    }

    // Map click handler
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        setMarkerAndUpdate(lat, lng);
    });

    // Search address button
    document.getElementById('searchAddressBtn').addEventListener('click', async function() {
        const address = document.getElementById('lokasi').value.trim();

        if (!address) {
            alert('Silakan masukkan alamat terlebih dahulu');
            return;
        }

        // Show loading
        const originalIcon = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.disabled = true;

        const found = await searchAddress(address);

        if (!found) {
            alert('Alamat tidak ditemukan. Coba dengan format yang lebih sederhana seperti:\n- Nama jalan + kota\n- Nama tempat terkenal\n- Atau gunakan GPS untuk lokasi saat ini');
        }

        // Reset button
        this.innerHTML = originalIcon;
        this.disabled = false;
    });

    // Enter key on address input
    document.getElementById('lokasi').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('searchAddressBtn').click();
        }
    });

    // Get current location button - FIXED GPS FUNCTION
    document.getElementById('getLocationBtn').addEventListener('click', function() {
        if (!navigator.geolocation) {
            alert('Browser Anda tidak mendukung geolocation.');
            return;
        }

        const originalIcon = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.disabled = true;

        // Use high accuracy GPS with longer timeout
        const options = {
            enableHighAccuracy: true,
            timeout: 15000, // 15 seconds timeout
            maximumAge: 0 // Don't use cached location
        };

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                console.log('GPS Location found:', lat, lng, 'Accuracy:', accuracy + 'm');

                // Center map on current location with appropriate zoom
                const zoom = accuracy < 100 ? 18 : accuracy < 500 ? 16 : 14;
                map.setView([lat, lng], zoom);
                setMarkerAndUpdate(lat, lng);

                // Show success feedback
                document.getElementById('getLocationBtn').innerHTML = '<i class="fas fa-check text-green-500"></i>';
                document.getElementById('getLocationBtn').disabled = false;

                // Show accuracy info
                if (accuracy > 100) {
                    alert(`Lokasi ditemukan dengan akurasi ${Math.round(accuracy)}m. Untuk hasil yang lebih akurat, pastikan Anda berada di area terbuka.`);
                }

                setTimeout(() => {
                    document.getElementById('getLocationBtn').innerHTML = originalIcon;
                }, 3000);
            },
            function(error) {
                console.error('GPS Error:', error);
                let errorMessage = 'Tidak dapat mengakses lokasi GPS. ';

                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage += 'Akses lokasi ditolak. Silakan izinkan akses lokasi di browser Anda.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage += 'Informasi lokasi tidak tersedia. Pastikan GPS aktif dan Anda berada di area dengan sinyal yang baik.';
                        break;
                    case error.TIMEOUT:
                        errorMessage += 'Permintaan lokasi timeout. Coba lagi atau pindah ke area dengan sinyal GPS yang lebih baik.';
                        break;
                    default:
                        errorMessage += 'Terjadi kesalahan yang tidak diketahui.';
                        break;
                }

                alert(errorMessage);

                // Reset button
                document.getElementById('getLocationBtn').innerHTML = originalIcon;
                document.getElementById('getLocationBtn').disabled = false;
            },
            options
        );
    });

    // Set initial location if exists (for validation errors)
    const initialLat = document.getElementById('latitude').value;
    const initialLng = document.getElementById('longitude').value;
    const initialAddress = document.getElementById('lokasi').value;

    if (initialLat && initialLng) {
        map.setView([initialLat, initialLng], 16);
        setMarkerAndUpdate(parseFloat(initialLat), parseFloat(initialLng), initialAddress);
    }
});

// Preview uploaded image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('uploadArea').classList.add('hidden');
            document.getElementById('imagePreview').classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Click preview to change image
document.getElementById('imagePreview').addEventListener('click', function() {
    document.getElementById('foto_bukti').click();
});

// Form validation and submission
document.getElementById('pengaduanForm').addEventListener('submit', function(e) {
    // Validate required fields
    const kategori = document.getElementById('kategori_id').value;
    const judul = document.getElementById('judul').value;
    const deskripsi = document.getElementById('deskripsi').value;
    const lokasi = document.getElementById('lokasi').value;
    const latitude = document.getElementById('latitude').value;
    const longitude = document.getElementById('longitude').value;

    if (!kategori || !judul || !deskripsi || !lokasi || !latitude || !longitude) {
        e.preventDefault();
        alert('Semua field wajib diisi! Pastikan Anda telah memilih lokasi di peta.');
        return;
    }

    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
    submitBtn.disabled = true;
});
</script>
@endsection
