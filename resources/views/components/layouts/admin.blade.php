<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mamachu Admin Panel</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('mazer/assets/compiled/svg/favicon.svg') }}" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons (for existing icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Custom CSS -->
    <style>
        /* === CSS Variables === */
        :root {
            --pop-primary: #FF6B6B;
            --pop-secondary: #FFD93D;
            --pop-dark: #2c3e50;
            --pop-light: #FFF5E4;
            --sidebar-width: 260px;
        }

        /* === Tailwind Config === */
        @layer utilities {
            .text-pop-primary {
                color: var(--pop-primary);
            }

            .bg-pop-primary {
                background-color: var(--pop-primary);
            }

            .text-pop-dark {
                color: var(--pop-dark);
            }

            .border-pop-primary {
                border-color: var(--pop-primary);
            }
        }

        /* === Global Styles === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #FFF5E4 0%, #FFE5E5 100%);
            min-height: 100vh;
        }

        /* === Sidebar Styles === */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #fff 0%, #fafafa 100%);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.06);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: var(--pop-primary);
            border-radius: 10px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .sidebar-logo {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--pop-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-logo .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--pop-primary) 0%, #ff8787 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .sidebar-user-card {
            padding: 1.25rem;
            margin: 1rem;
            background: linear-gradient(135deg, #FFF5E4 0%, #FFE5E5 100%);
            border-radius: 1.25rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar-user-card:hover {
            border-color: var(--pop-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(255, 107, 107, 0.15);
        }

        .sidebar-user-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 3px solid var(--pop-primary);
            object-fit: cover;
        }

        .user-role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--pop-primary);
            color: white;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .sidebar-menu {
            padding: 1rem 0.75rem;
        }

        .sidebar-title {
            padding: 0.75rem 1rem;
            color: #9ca3af;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-item {
            margin-bottom: 0.375rem;
            list-style: none;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--pop-primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(255, 107, 107, 0.1) 0%, transparent 100%);
            color: var(--pop-primary);
            transform: translateX(4px);
        }

        .sidebar-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-link i {
            font-size: 1.125rem;
            width: 24px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        .sidebar-item.active .sidebar-link {
            background: linear-gradient(135deg, var(--pop-primary) 0%, #ff8787 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        }

        .sidebar-item.active .sidebar-link::before {
            transform: scaleY(1);
            background: white;
        }

        .logout-link {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            font-weight: 600;
        }

        .logout-link:hover {
            background: linear-gradient(135deg, #fecaca 0%, #fee2e2 100%);
            transform: translateX(0) !important;
        }

        /* === Main Content Area === */
        #main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* === Navbar Styles === */
        .navbar-top {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #f0f0f0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .burger-btn {
            display: none;
            font-size: 1.5rem;
            color: var(--pop-dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .burger-btn:hover {
            color: var(--pop-primary);
            transform: scale(1.1);
        }

        /* === Main Content === */
        #main-content {
            flex: 1;
            padding: 0;
        }

        /* === Footer Styles === */
        footer {
            background: white;
            border-top: 2px solid #f0f0f0;
            padding: 1.5rem;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .footer-brand {
            font-weight: 700;
            color: var(--pop-dark);
        }

        .footer-heart {
            color: var(--pop-primary);
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {

            0%,
            100% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.1);
            }

            50% {
                transform: scale(1);
            }
        }

        /* === Responsive Styles === */
        @media (max-width: 1024px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.active {
                transform: translateX(0);
            }

            #main {
                margin-left: 0;
            }

            .burger-btn {
                display: block;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .navbar-top {
                padding: 1rem;
            }
        }

        /* === Custom Scrollbar === */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--pop-primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff5252;
        }

        /* === SweetAlert Custom Styles === */
        .swal2-confirm {
            background-color: var(--pop-primary) !important;
        }

        /* === Table Improvements === */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* === Utility Classes === */
        .gradient-text {
            background: linear-gradient(135deg, var(--pop-primary) 0%, #ff8787 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pop-primary': '#FF6B6B',
                        'pop-secondary': '#FFD93D',
                        'pop-dark': '#2c3e50',
                        'pop-light': '#FFF5E4',
                    },
                    fontFamily: {
                        'heading': ['Inter', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body>
    <div id="app">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        @include('components.layouts.partials.sidebar')

        <div id="main">
            @include('components.layouts.partials.navbar')

            <div id="main-content">
                {{ $slot }}
                @include('components.layouts.partials.footer')
            </div>
        </div>
    </div>

    @livewire('auth.logout')

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Sidebar Toggle for Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.querySelector('.burger-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const sidebarHide = document.querySelector('.sidebar-hide');

            if (burgerBtn) {
                burgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            if (sidebarHide) {
                sidebarHide.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
        });

        // Livewire Event Listeners
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:success', (event) => {
                const {
                    title,
                    text
                } = event;
                Swal.fire({
                    icon: 'success',
                    title: title,
                    text: text,
                    timer: 2000,
                    showConfirmButton: false,
                    confirmButtonColor: '#FF6B6B',
                });
            });

            Livewire.on('swal:error', (event) => {
                const {
                    title,
                    text
                } = event;
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: text,
                    confirmButtonColor: '#FF6B6B',
                });
            });
        });
    </script>

    {{-- Session Error Handling --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '{{ session('error') }}',
                confirmButtonColor: '#FF6B6B',
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
