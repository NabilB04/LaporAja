<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar - LaporAja | Pemerintah Jember</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .error-message {
            display: none;
        }

        .error-message.show {
            display: block;
        }

    </style>
</head>

<body class="bg-[#d46a6d] min-h-screen flex items-center justify-center p-4">
    <div class="flex flex-col lg:flex-row items-center justify-center max-w-6xl w-full gap-8 lg:gap-16">

        <!-- Registration Form -->
        <div class="w-full max-w-4xl">
            <form id="registerForm" method="POST" action="{{ route('register') }}"
                enctype="multipart/form-data" class="bg-[#f5e6d3] rounded-3xl shadow-2xl p-8 lg:p-12">
                @csrf
                <!-- Header with icon and title -->
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('img/laporaja-logo.png') }}" alt="Logo LaporAja!"
                        class="h-16 w-auto object-contain drop-shadow-md" />
                </div>

                <!-- Registration title and subtitle -->
                <div class="text-center mb-8">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="#" id="loginLink"
                            class="font-medium text-red-600 hover:text-red-500 transition duration-200">
                            masuk disini
                        </a>
                    </p>
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="error-message mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan!</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul id="errorList" class="list-disc list-inside space-y-1">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="space-y-6 mb-6">

                    <!-- Row 1: Nama Lengkap - Kata Sandi -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Name field -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="nama" name="nama" type="text" required autocomplete="name"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Masukkan nama lengkap" />
                            </div>
                        </div>

                        <!-- Password field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    autocomplete="new-password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Minimal 8 karakter" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password"
                                    data-target="password">
                                    <i class="fas fa-eye text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Alamat Email - Konfirmasi Kata Sandi -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Email field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required autocomplete="email"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="nama@example.com" />
                            </div>
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    autocomplete="new-password"
                                    class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Ulangi kata sandi" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password"
                                    data-target="password_confirmation">
                                    <i class="fas fa-eye text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Nomor HP (Full Width) -->
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input id="no_hp" name="no_hp" type="tel" required autocomplete="tel"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="08xxxxxxxxxx" />
                        </div>
                    </div>

                    <!-- Row 4: Alamat (Full Width) -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                                placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>

                </div>

                <!-- Submit button -->
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 mb-6">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus text-red-500 group-hover:text-red-400"></i>
                    </span>
                    Daftar Sekarang
                </button>

            </form>

            @if(session('show_verification_popup'))
                <!-- Modal -->
                <div id="verificationModal"
                    class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-xl w-full max-w-md text-center shadow-lg">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Verifikasi Email Diperlukan</h2>
                        <p class="text-gray-600 mb-2">
                            Kami telah mengirim email verifikasi ke:
                        </p>
                        <p class="text-blue-600 font-semibold mb-4">{{ session('registered_email') }}
                        </p>
                        <p class="text-sm text-gray-500 mb-6">Silakan cek email dan klik link verifikasi sebelum login.
                        </p>

                        <div class="flex justify-center gap-4">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Kirim Ulang Email
                                </button>
                            </form>
                            <a href="{{ route('login') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                                Sudah Verifikasi
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Back to home link -->
            <div class="text-center mt-6">
                <a href="#" id="homeLink"
                    class="inline-flex items-center text-sm text-white hover:text-gray-200 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke beranda
                </a>
            </div>
        </div>

    </div>

<script>
    // Form validation and submission
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const no_hp = document.getElementById('no_hp').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        // Clear previous errors
        hideErrorMessage();

        // Validation
        const errors = [];

        if (!nama) {
            errors.push('Nama lengkap wajib diisi');
        } else if (nama.length < 3) {
            errors.push('Nama lengkap minimal 3 karakter');
        }

        if (!email) {
            errors.push('Alamat email wajib diisi');
        } else if (!isValidEmail(email)) {
            errors.push('Format alamat email tidak valid');
        }

        if (!no_hp) {
            errors.push('Nomor HP wajib diisi');
        } else if (!isValidPhone(no_hp)) {
            errors.push('Format nomor HP tidak valid (contoh: 08123456789)');
        }

        if (!alamat) {
            errors.push('Alamat wajib diisi');
        } else if (alamat.length < 10) {
            errors.push('Alamat terlalu singkat (minimal 10 karakter)');
        }

        if (!password) {
            errors.push('Kata sandi wajib diisi');
        } else if (password.length < 8) {
            errors.push('Kata sandi minimal 8 karakter');
        }

        if (!password_confirmation) {
            errors.push('Konfirmasi kata sandi wajib diisi');
        } else if (password !== password_confirmation) {
            errors.push('Konfirmasi kata sandi tidak cocok');
        }

        if (errors.length > 0) {
            showErrorMessage(errors);
            e.preventDefault(); // Stop submit if error
        }
    });

    // Validation helpers
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^(08|628)[0-9]{8,12}$/;
        return phoneRegex.test(phone);
    }

    function showErrorMessage(errors) {
        const errorMessage = document.getElementById('errorMessage');
        const errorList = document.getElementById('errorList');
        errorList.innerHTML = '';
        errors.forEach(error => {
            const li = document.createElement('li');
            li.textContent = error;
            errorList.appendChild(li);
        });
        errorMessage.classList.add('show');
        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideErrorMessage() {
        document.getElementById('errorMessage').classList.remove('show');
    }

    // Auto-hide error message when user types
    ['nama', 'email', 'no_hp', 'alamat', 'password', 'password_confirmation'].forEach(inputId => {
        document.getElementById(inputId).addEventListener('input', hideErrorMessage);
    });

    // Phone formatting
    document.getElementById('no_hp').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('62')) {
            value = '0' + value.substring(2);
        }
        e.target.value = value;
    });

    // Password toggle
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const inputId = this.dataset.target;
            const input = document.getElementById(inputId);
            const icon = this.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });

    // Optional: link handlers (if needed)
    const loginLink = document.getElementById('loginLink');
    if (loginLink) {
        loginLink.addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = '/login';
        });
    }

    const homeLink = document.getElementById('homeLink');
    if (homeLink) {
        homeLink.addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = '/';
        });
    }
</script>
</body>

</html>
