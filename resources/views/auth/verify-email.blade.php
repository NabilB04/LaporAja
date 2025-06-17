<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - LaporAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fef7f6] min-h-screen flex items-center justify-center">

    <div class="bg-white max-w-md w-full p-8 rounded-xl shadow-md border border-red-100">
        <div class="text-center mb-6">
            <img src="{{ asset('img/laporaja-logo.png') }}" alt="Logo LaporAja" class="h-12 mx-auto mb-4">
            <h1 class="text-xl font-semibold text-gray-800">Verifikasi Email Kamu</h1>
            <p class="text-sm text-gray-600 mt-2">
                Sebelum lanjut, buka email dan klik link verifikasi yang telah kami kirim.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
                Link verifikasi baru telah dikirim ke alamat email kamu.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="text-center">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition">
                Kirim Ulang Link Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center mt-6">
            @csrf
            <button type="submit"
                class="text-gray-600 hover:text-gray-800 underline text-sm">
                Keluar
            </button>
        </form>
    </div>

</body>
</html>
