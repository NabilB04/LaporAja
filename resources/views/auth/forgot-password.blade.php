<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Password - LaporAja | Pemerintah Jember</title>
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

        <!-- Forgot Password Form -->
        <div class="w-full">
            <div class="bg-[#f5e6d3] rounded-3xl shadow-2xl p-8 lg:p-10">

                <!-- Header with icon and title -->
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('img/laporaja-logo.png') }}" alt="Logo LaporAja!"
                        class="h-16 w-auto object-contain drop-shadow-md" />
                </div>

                <!-- Title and subtitle -->
                <div class="text-center mb-8">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Lupa Kata Sandi</h2>
                    <p class="text-sm text-gray-600">
                        Masukkan email Anda untuk menerima link reset password
                    </p>
                </div>

                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <div class="text-sm text-green-700">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                placeholder="nama@example.com" />
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 mb-6">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-paper-plane text-red-500 group-hover:text-red-400"></i>
                        </span>
                        Kirim Link Reset
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
