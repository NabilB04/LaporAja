<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Password - LaporAja | Pemerintah Jember</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body class="bg-[#d46a6d] min-h-screen flex items-center justify-center p-4">
    <div class="flex flex-col items-center justify-center max-w-md w-full">

        <!-- Reset Password Form -->
        <div class="w-full">
            <div class="bg-[#f5e6d3] rounded-3xl shadow-2xl p-8 lg:p-10">

                <!-- Header with icon and title -->
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('img/laporaja-logo.png') }}" alt="Logo LaporAja!"
                        class="h-16 w-auto object-contain drop-shadow-md" />
                </div>

                <!-- Title and subtitle -->
                <div class="text-center mb-8">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Reset Kata Sandi</h2>
                    <p class="text-sm text-gray-600">
                        Masukkan kata sandi baru untuk akun Anda
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="space-y-6 mb-6">
                        <!-- New Password field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Minimal 8 karakter" />
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Confirmation field -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password_confirmation" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Ulangi kata sandi baru" />
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 mb-6">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-key text-red-500 group-hover:text-red-400"></i>
                        </span>
                        Reset Password
                    </button>
                </form>

            </div>
        </div>

        <!-- Back to home link -->
        <div class="text-center mt-6">
            <a href="{{ route('login') }}"
                class="inline-flex items-center text-sm text-white hover:text-gray-200 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke login
            </a>
        </div>

    </div>
</body>

</html>
