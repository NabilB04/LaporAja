@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header Form -->
        <div class="bg-[#d46a6d] px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Form Tanggapan</h2>
        </div>

        <!-- Form Container -->
        <form action="{{ route('admin.tanggapan.store', $pengaduan) }}" method="POST" enctype="multipart/form-data" class="px-6 py-4">
            @csrf

            <!-- Isi Tanggapan -->
            <div class="mb-6">
                <label for="isi_tanggapan" class="block text-gray-700 font-medium mb-2">Isi Tanggapan *</label>
                <textarea name="isi_tanggapan" id="isi_tanggapan" rows="5" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tulis tanggapan Anda disini...">{{ old('isi_tanggapan') }}</textarea>
                @error('isi_tanggapan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Upload Foto *</label>

                <!-- File Input -->
                <div class="flex items-center justify-center w-full">
                    <label for="foto_tanggapan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                        </div>
                        <input id="foto_tanggapan" name="foto_tanggapan" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>

                @error('foto_tanggapan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Preview Container -->
                <div id="preview-container" class="mt-4 hidden">
                    <div class="relative max-w-xs">
                        <img id="image-preview" class="w-full h-48 object-contain rounded-lg border border-gray-200">
                        <button type="button" id="remove-preview" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                            ×
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pilih Status Baru -->
            <div class="mb-6">
                <label for="status_id" class="block text-gray-700 font-medium mb-2">Ubah Status *</label>
                <select name="status_id" id="status_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach($opsiStatus as $status)
                        <option value="{{ $status->status_id }}" {{ ($status->nama_status == 'Diproses') ? 'selected' : '' }}>
                            {{ $status->nama_status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.detail-pengaduan', $pengaduan->pengaduan_id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kembali
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-[#d46a6d] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan Tanggapan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('foto_tanggapan');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const removeButton = document.getElementById('remove-preview');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    resetFileInput();
                    return;
                }

                if (!file.type.match('image.*')) {
                    alert('Hanya file gambar yang diizinkan');
                    resetFileInput();
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            }
        });

        removeButton.addEventListener('click', function() {
            resetFileInput();
            previewContainer.classList.add('hidden');
        });

        function resetFileInput() {
            fileInput.value = '';
            imagePreview.src = '';
        }
    });
</script>
@endsection
