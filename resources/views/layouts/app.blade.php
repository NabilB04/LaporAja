<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LaporAja - Platform digital untuk menyampaikan pengaduan infrastruktur dan layanan publik Kabupaten Jember">
    <meta name="keywords" content="laporan, pengaduan, infrastruktur, layanan publik, jember, laporaja">
    <meta name="author" content="LaporAja Team">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'LaporAja - Sistem Pengaduan Masyarakat Kabupaten Jember')">
    <meta property="og:description" content="Platform digital untuk menyampaikan pengaduan dan aspirasi infrastruktur & layanan publik di Kabupaten Jember">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/laporaja-og.jpg">

    <title>@yield('title', 'LaporAja - Sistem Pengaduan Masyarakat Kabupaten Jember')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        secondary: {
                            50: '#fefdf8',
                            100: '#fef9e7',
                            200: '#fef3c7',
                            300: '#fde68a',
                            400: '#fcd34d',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        accent: {
                            50: '#fdf2f2',
                            100: '#fce7e7',
                            200: '#f9d5d5',
                            300: '#f5b5b5',
                            400: '#ef8a8a',
                            500: '#e65f5f',
                            600: '#d46a6d',
                            700: '#b85c5f',
                            800: '#9a4d50',
                            900: '#7f4042',
                        },
                        cream: {
                            50: '#fffef7',
                            100: '#fffbeb',
                            200: '#fef3c7',
                            300: '#f5e6d3',
                            400: '#e6d3b7',
                            500: '#d6c29a',
                            600: '#c4a775',
                            700: '#a68b5b',
                            800: '#8b7355',
                            900: '#705d47',
                        },
                        success: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        warning: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        danger: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                        'display': ['Poppins', 'ui-sans-serif', 'system-ui'],
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(212, 106, 109, 0.1), 0 10px 20px -2px rgba(212, 106, 109, 0.05)',
                        'medium': '0 4px 25px -5px rgba(212, 106, 109, 0.15), 0 10px 10px -5px rgba(212, 106, 109, 0.05)',
                        'large': '0 10px 40px -10px rgba(212, 106, 109, 0.2), 0 20px 25px -5px rgba(212, 106, 109, 0.05)',
                        'coral': '0 4px 20px -2px rgba(212, 106, 109, 0.3)',
                        'cream': '0 4px 20px -2px rgba(245, 230, 211, 0.4)',
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                        'hero-pattern': "url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23d46a6d\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')",
                        'coral-gradient': 'linear-gradient(135deg, #d46a6d 0%, #e65f5f 100%)',
                        'cream-gradient': 'linear-gradient(135deg, #f5e6d3 0%, #e6d3b7 100%)',
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.5s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                        'pulse-coral': 'pulseCoralColor 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100%)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-100%)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.95)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-5px)' },
                        },
                        pulseCoralColor: {
                            '0%, 100%': { backgroundColor: '#d46a6d' },
                            '50%': { backgroundColor: '#e65f5f' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #fef9e7;
        }

        ::-webkit-scrollbar-thumb {
            background: #d46a6d;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #e65f5f;
        }

        /* Smooth transitions */
        * {
            transition: color 0.2s ease, background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Focus states */
        .focus-ring {
            @apply focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2;
        }

        /* Button styles */
        .btn-primary {
            @apply bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring shadow-coral;
        }

        .btn-secondary {
            @apply bg-cream-300 hover:bg-cream-400 text-accent-800 font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring shadow-cream;
        }

        .btn-accent {
            @apply bg-accent-600 hover:bg-accent-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring shadow-coral;
        }

        .btn-success {
            @apply bg-success-600 hover:bg-success-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring;
        }

        .btn-warning {
            @apply bg-warning-500 hover:bg-warning-600 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring;
        }

        .btn-danger {
            @apply bg-danger-600 hover:bg-danger-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 focus-ring;
        }

        /* Card styles */
        .card {
            @apply bg-cream-50 rounded-xl shadow-soft border border-cream-200 overflow-hidden;
        }

        .card-elevated {
            @apply bg-cream-50 rounded-xl shadow-medium border border-cream-200 overflow-hidden;
        }

        .card-white {
            @apply bg-white rounded-xl shadow-soft border border-cream-200 overflow-hidden;
        }

        /* Badge styles */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }

        .badge-primary {
            @apply bg-primary-100 text-primary-800;
        }

        .badge-accent {
            @apply bg-accent-100 text-accent-800;
        }

        .badge-success {
            @apply bg-success-100 text-success-800;
        }

        .badge-warning {
            @apply bg-warning-100 text-warning-800;
        }

        .badge-danger {
            @apply bg-danger-100 text-danger-800;
        }

        /* Loading animation */
        .loading-spinner {
            @apply inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-current;
        }

        /* Hero background pattern */
        .hero-bg {
            background-image:
                linear-gradient(135deg, rgba(212, 106, 109, 0.1) 0%, rgba(230, 95, 95, 0.05) 100%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23d46a6d" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        }

        /* Alternative background */
        .coral-bg {
            background: linear-gradient(135deg, #d46a6d 0%, #e65f5f 100%);
        }

        .cream-bg {
            background: linear-gradient(135deg, #f5e6d3 0%, #fef9e7 100%);
        }

        /* Glass effect */
        .glass {
            backdrop-filter: blur(10px);
            background: rgba(245, 230, 211, 0.8);
            border: 1px solid rgba(245, 230, 211, 0.3);
        }

        .glass-coral {
            backdrop-filter: blur(10px);
            background: rgba(212, 106, 109, 0.8);
            border: 1px solid rgba(212, 106, 109, 0.3);
        }

        /* Text selection */
        ::selection {
            background-color: rgba(212, 106, 109, 0.2);
        }

        /* Input styles */
        .input-primary {
            @apply w-full px-4 py-3 border border-cream-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500 transition duration-200 bg-white;
        }

        .input-primary:focus {
            @apply border-accent-500 ring-accent-500;
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .dark-auto {
                @apply bg-gray-900 text-white;
            }
        }

        /* Custom patterns */
        .pattern-dots {
            background-image: radial-gradient(circle, #d46a6d 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.1;
        }

        .pattern-grid {
            background-image:
                linear-gradient(rgba(212, 106, 109, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212, 106, 109, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gradient-to-br from-cream-50 to-accent-50 min-h-screen font-sans antialiased">
    <!-- Skip to content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-primary-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Loading indicator (can be controlled via JavaScript) -->
    <div id="loading-indicator" class="fixed top-0 left-0 w-full h-1 bg-accent-200 z-50 hidden">
        <div class="h-full bg-accent-600 animate-pulse-coral"></div>
    </div>

    <!-- Main content -->
    <main id="main-content" class="relative">
        @yield('content')
    </main>

    <!-- Toast notifications container -->
    <div id="toast-container" class="fixed top-4 right-4 space-y-2 z-50 pointer-events-none">
        <!-- Toast notifications will be inserted here via JavaScript -->
    </div>

    <!-- Back to top button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-accent-600 hover:bg-accent-700 text-white p-3 rounded-full shadow-coral transition-all duration-300 transform scale-0 focus-ring z-40">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Base JavaScript -->
    <script>
        // Utility functions
        window.LaporAja = {
            // Show loading indicator
            showLoading: function() {
                document.getElementById('loading-indicator').classList.remove('hidden');
            },

            // Hide loading indicator
            hideLoading: function() {
                document.getElementById('loading-indicator').classList.add('hidden');
            },

            // Show toast notification
            showToast: function(message, type = 'info', duration = 3000) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');

                const colors = {
                    success: 'bg-success-600 text-white',
                    error: 'bg-danger-600 text-white',
                    warning: 'bg-warning-500 text-white',
                    info: 'bg-accent-600 text-white'
                };

                const icons = {
                    success: 'fas fa-check-circle',
                    error: 'fas fa-exclamation-circle',
                    warning: 'fas fa-exclamation-triangle',
                    info: 'fas fa-info-circle'
                };

                toast.className = `${colors[type]} px-4 py-3 rounded-lg shadow-coral pointer-events-auto animate-slide-down max-w-sm`;
                toast.innerHTML = `
                    <div class="flex items-center">
                        <i class="${icons[type]} mr-3"></i>
                        <span class="flex-1">${message}</span>
                        <button class="ml-3 hover:opacity-70" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                container.appendChild(toast);

                if (duration > 0) {
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.classList.add('animate-slide-up');
                            setTimeout(() => toast.remove(), 300);
                        }
                    }, duration);
                }
            },

            // Format date
            formatDate: function(date, format = 'dd/mm/yyyy') {
                const d = new Date(date);
                const day = String(d.getDate()).padStart(2, '0');
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const year = d.getFullYear();

                switch(format) {
                    case 'dd/mm/yyyy':
                        return `${day}/${month}/${year}`;
                    case 'yyyy-mm-dd':
                        return `${year}-${month}-${day}`;
                    default:
                        return d.toLocaleDateString('id-ID');
                }
            },

            // Smooth scroll to element
            scrollTo: function(element, offset = 0) {
                const targetElement = typeof element === 'string' ? document.querySelector(element) : element;
                if (targetElement) {
                    const targetPosition = targetElement.offsetTop - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        };

        // Back to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('back-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('scale-0');
                    backToTopButton.classList.add('scale-100');
                } else {
                    backToTopButton.classList.remove('scale-100');
                    backToTopButton.classList.add('scale-0');
                }
            });

            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        LaporAja.scrollTo(target, 80);
                    }
                });
            });

            // Initialize tooltips and other interactive elements
            initializeTooltips();

            // Demo toast notifications
            setTimeout(() => {
                LaporAja.showToast('Selamat datang di LaporAja!', 'info');
            }, 1000);
        });

        // Initialize tooltips
        function initializeTooltips() {
            const tooltipTriggers = document.querySelectorAll('[data-tooltip]');
            tooltipTriggers.forEach(trigger => {
                trigger.addEventListener('mouseenter', showTooltip);
                trigger.addEventListener('mouseleave', hideTooltip);
            });
        }

        function showTooltip(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute bg-gray-900 text-white text-sm px-2 py-1 rounded shadow-lg z-50 pointer-events-none';
            tooltip.textContent = e.target.getAttribute('data-tooltip');
            tooltip.id = 'tooltip';

            document.body.appendChild(tooltip);

            const rect = e.target.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
        }

        function hideTooltip() {
            const tooltip = document.getElementById('tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
