<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin LaporAja | Pemerintah Jember</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body class="bg-[#f5e6d3] min-h-screen">
    <div class="min-h-screen bg-[#f5e6d3]">
        <div class="flex">
            <!-- Sidebar -->
            @include('layouts.admin.components.sidebar-admin')

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Navbar -->
                @include('layouts.admin.components.navbar-admin')

                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
    document.getElementById('logoutButton').addEventListener('click', function (e) {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Kamu akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
</body>
</html>
