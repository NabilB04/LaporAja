<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Masuk - LaporAja | Pemerintah Jember</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    body {
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>
<body class="bg-[#d46a6d] min-h-screen flex items-center justify-center p-4">
  <div class="flex flex-col lg:flex-row items-center justify-center max-w-6xl w-full gap-8 lg:gap-16">

    <!-- Left side - Government Section -->
    <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
      <h1 class="text-left text-white font-extrabold text-4xl lg:text-6xl mb-6 lg:mb-8 select-none tracking-wider">
        PEMERINTAH
      </h1>

      <!-- Government Logo/Emblem -->
      <div class="flex items-center justify-center">
        <img
          src="{{ asset('img/logo-jember.png') }}"
          alt="Logo Pemerintah Kabupaten Jember"
          class="w-72 h-80 lg:w-80 lg:h-96 object-contain drop-shadow-2xl ml-10"
        />
      </div>
    </div>

    <!-- Right side - Login Form -->
    <div class="w-full max-w-md">
      <form method="POST" action="{{ route('login') }}" class="bg-[#f5e6d3] rounded-3xl shadow-2xl p-8 lg:p-10">
        @csrf

        <!-- Header with icon and title -->
        <div class="flex items-center justify-center mb-4">
          <img
            src="{{ asset('img/laporaja-logo.png') }}"
            alt="Logo LaporAja!"
            class="h-16 w-auto object-contain drop-shadow-md"
          />
        </div>

        <!-- Masuk title and subtitle -->
        <div class="text-center mb-6">
          <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Masuk ke akun Anda</h2>
          <p class="text-sm text-gray-600">
            Atau
            <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-500 transition duration-200">
              daftar akun baru disini
            </a>
          </p>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
          <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan!</h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Email field -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input
              id="email"
              name="email"
              type="email"
              required
              value="{{ old('email') }}"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
              placeholder="nama@example.com"
            />
          </div>
        </div>

        <!-- Password field -->
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input
              id="password"
              name="password"
              type="password"
              required
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
              placeholder="Masukkan kata sandi"
            />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('password', this)">
                <i class="fas fa-eye text-gray-400" id="icon-password"></i>
            </div>
          </div>
        </div>

        <!-- Remember me and Forgot password -->
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <input
              id="remember"
              name="remember"
              type="checkbox"
              class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
            />
            <label for="remember" class="ml-2 block text-sm text-gray-900">
              Ingat saya
            </label>
          </div>
          <div>
            <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-500 transition duration-200">
              Lupa password?
            </a>
          </div>
        </div>

        <!-- Submit button -->
        <button
          type="submit"
          class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200 mb-6"
        >
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <i class="fas fa-sign-in-alt text-red-500 group-hover:text-red-400"></i>
          </span>
          Masuk
        </button>
      </form>

      <!-- Back to home link -->
      <div class="text-center mt-6">
        <a href="{{ url('/#welcome') }}" class="inline-flex items-center text-sm text-white hover:text-gray-200 transition duration-200">
          <i class="fas fa-arrow-left mr-2"></i>
          Kembali ke beranda
        </a>
      </div>
    </div>
  </div>

    <script>
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const icon = iconElement.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>
</html>
