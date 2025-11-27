<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mamachu - Segarkan Harimu!' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pop-primary': '#FF6B6B',
                        'pop-secondary': '#FFD93D',
                        'pop-accent': '#4D96FF',
                        'pop-dark': '#2D2D2D',
                        'pop-light': '#FFF5F5',
                    },
                    fontFamily: {
                        'heading': ['Fredoka', 'sans-serif'],
                        'body': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Styles */
        .float-anim {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #FF6B6B;
            border-radius: 10px;
        }
    </style>
    @stack('styles')
</head>

<body class="font-body bg-pop-light text-pop-dark overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/"
                class="text-3xl font-heading font-bold text-pop-primary tracking-wide flex items-center gap-2">
                <i class="fa-solid fa-bottle-droplet animate-bounce"></i> MAMACHU
            </a>

            <div class="hidden md:flex space-x-8 font-semibold text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-pop-primary transition">Beranda</a>
                <a href="{{ route('categories') }}" class="hover:text-pop-primary transition">Kategori</a>
                <a href="{{ route('brands') }}" class="hover:text-pop-primary transition">Brand</a>
                <a href="{{ route('featured') }}" class="hover:text-pop-primary transition">Unggulan</a>
                <a href="#about" class="hover:text-pop-primary transition">Tentang</a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                @auth
                    @livewire('components.cart-counter')
                @else
                    <a href="{{ route('login') }}" class="relative text-gray-600 hover:text-pop-primary transition group">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-gray-400 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>
                @endauth

                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" id="profile-dropdown-container">
                        <button id="profile-dropdown-btn"
                            class="flex items-center space-x-2 text-gray-600 hover:text-pop-primary transition focus:outline-none group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-pop-primary to-red-500 rounded-full flex items-center justify-center text-white shadow-lg group-hover:shadow-xl group-hover:scale-105 transition">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50 opacity-0 transform scale-95 transition-all duration-200">
                            <div class="bg-gradient-to-r from-pop-primary to-red-500 px-4 py-3 text-white">
                                <p class="font-semibold text-sm">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs opacity-90">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('user.profile') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pop-light hover:text-pop-primary transition group">
                                    <i class="fa-solid fa-user-circle text-lg group-hover:scale-110 transition"></i>
                                    <span class="font-medium">My Profile</span>
                                </a>
                                <a href="{{ route('user.my-orders') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pop-light hover:text-pop-primary transition group">
                                    <i class="fa-solid fa-shopping-bag text-lg group-hover:scale-110 transition"></i>
                                    <span class="font-medium">My Order</span>
                                </a>
                                <hr class="my-2 border-gray-200">
                                <a href="#" onclick="event.preventDefault(); confirmLogout();"
                                    class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition group">
                                    <i class="fa-solid fa-right-from-bracket text-lg group-hover:scale-110 transition"></i>
                                    <span class="font-medium">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-pop-primary text-white px-5 py-2 rounded-full font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-red-200">
                        Masuk
                    </a>
                @endauth
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-2xl text-pop-dark focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t absolute w-full shadow-lg">
            <div class="flex flex-col px-6 py-4 space-y-4 font-semibold text-lg">
                <a href="{{ route('home') }}" class="hover:text-pop-primary">Beranda</a>
                <a href="{{ route('categories') }}" class="hover:text-pop-primary">Kategori</a>
                <a href="{{ route('brands') }}" class="hover:text-pop-primary">Brand</a>
                <a href="{{ route('featured') }}" class="hover:text-pop-primary">Unggulan</a>
                <a href="#about" class="hover:text-pop-primary">Tentang</a>
                <hr class="border-gray-200">
                <a href="#" class="flex items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-cart-shopping"></i> Keranjang (3)
                </a>

                @auth
                    <hr class="border-gray-200">
                    <!-- Mobile Profile Section -->
                    <div class="bg-gradient-to-r from-pop-primary to-red-500 rounded-xl p-4 text-white">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-user text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs opacity-90">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.profile') }}"
                        class="flex items-center gap-3 text-gray-700 hover:text-pop-primary transition">
                        <i class="fa-solid fa-user-circle text-xl"></i>
                        <span>My Profile</span>
                    </a>
                    <a href="{{ route('user.my-orders') }}"
                        class="flex items-center gap-3 text-gray-700 hover:text-pop-primary transition">
                        <i class="fa-solid fa-shopping-bag text-xl"></i>
                        <span>My Order</span>
                    </a>
                    <a href="#" onclick="event.preventDefault(); confirmLogout('mobile');"
                        class="flex items-center gap-3 text-red-600 hover:text-red-700 transition">
                        <i class="fa-solid fa-right-from-bracket text-xl"></i>
                        <span>Logout</span>
                    </a>

                    <!-- Mobile Logout Form -->
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block text-center bg-pop-primary text-white py-2 rounded-full">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-pop-dark text-white pt-16 pb-8 rounded-t-[3rem] mt-10">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-10">
                <a href="#"
                    class="inline-flex items-center gap-2 text-4xl font-heading font-bold text-white tracking-wide hover:text-pop-primary transition duration-300">
                    <i class="fa-solid fa-bottle-droplet text-pop-primary animate-pulse"></i> MAMACHU
                </a>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto text-lg">
                    Teman setia di kala haus. Menyediakan ribuan minuman segar dengan pengiriman tercepat.
                </p>
            </div>

            <div class="w-full h-px bg-gray-800 mb-10"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-gray-400 text-sm">
                <div class="flex items-center gap-3 bg-gray-800/50 px-6 py-3 rounded-full">
                    <i class="fa-solid fa-location-dot text-pop-primary text-lg"></i>
                    <span>Jl. Soda Gembira No. 88, Jakarta Selatan</span>
                </div>

                <div class="flex gap-4">
                    <a href="https://www.instagram.com/jeky.zhrn?igsh=MWgyYWwxcXVveXZsMQ=="
                        class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i
                            class="fa-brands fa-instagram text-xl"></i></a>
                    <a href="#"
                        class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i
                            class="fa-brands fa-twitter text-xl"></i></a>
                    <a href="https://wa.me/qr/47ET3M5S6GL7C1"
                        class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i
                            class="fa-brands fa-whatsapp text-xl"></i></a>
                    <a href="https://clicky.id/zaky"
                        class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i
                            class="fa-solid fa-envelope text-xl"></i></a>
                </div>

                <div class="flex items-center gap-3 bg-gray-800/50 px-6 py-3 rounded-full">
                    <i class="fa-solid fa-phone text-pop-primary text-lg"></i>
                    <span>+62 812 3456 7890</span>
                </div>
            </div>

            <div class="mt-12 text-gray-600 text-xs">
                <p>&copy; 2024 Mamachu Inc. All rights reserved. Dibuat dengan <i
                        class="fa-solid fa-heart text-red-500 mx-1"></i> dan Soda.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.onscroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
                navbar.classList.replace('py-4', 'py-2');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.replace('py-2', 'py-4');
            }
        };

        // Profile Dropdown Toggle
        const profileBtn = document.getElementById('profile-dropdown-btn');
        const profileMenu = document.getElementById('profile-dropdown-menu');
        const profileContainer = document.getElementById('profile-dropdown-container');

        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();

                // Toggle dropdown visibility
                if (profileMenu.classList.contains('hidden')) {
                    profileMenu.classList.remove('hidden');
                    setTimeout(() => {
                        profileMenu.classList.remove('opacity-0', 'scale-95');
                        profileMenu.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    profileMenu.classList.remove('opacity-100', 'scale-100');
                    profileMenu.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        profileMenu.classList.add('hidden');
                    }, 200);
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (profileContainer && !profileContainer.contains(e.target)) {
                    if (!profileMenu.classList.contains('hidden')) {
                        profileMenu.classList.remove('opacity-100', 'scale-100');
                        profileMenu.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            profileMenu.classList.add('hidden');
                        }, 200);
                    }
                }
            });
        }

        // Logout Confirmation Function
        function confirmLogout(type = 'desktop') {
            Swal.fire({
                title: 'Keluar dari Akun?',
                text: 'Apakah Anda yakin ingin keluar dari akun Anda?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF6B6B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'font-body',
                    title: 'font-heading',
                    confirmButton: 'font-semibold',
                    cancelButton: 'font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the appropriate logout form
                    if (type === 'mobile') {
                        document.getElementById('logout-form-mobile').submit();
                    } else {
                        document.getElementById('logout-form').submit();
                    }
                }
            });
        }

        // Add to Cart Alert Function
        function addToCart(productName) {
            const notif = document.createElement('div');
            notif.className =
                'fixed bottom-5 right-5 bg-pop-dark text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3 transform translate-y-20 transition-all duration-300 z-50';
            notif.innerHTML =
                `<i class="fa-solid fa-circle-check text-green-400"></i> <span><b>${productName}</b> masuk keranjang!</span>`;

            document.body.appendChild(notif);

            setTimeout(() => {
                notif.classList.remove('translate-y-20');
            }, 100);
            setTimeout(() => {
                notif.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => notif.remove(), 300);
            }, 3000);
        }
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
