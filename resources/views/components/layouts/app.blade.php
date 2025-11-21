<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mamachu - Segarkan Harimu!' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        .float-anim { animation: float 4s ease-in-out infinite; }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #FF6B6B; border-radius: 10px; }
    </style>
</head>
<body class="font-body bg-pop-light text-pop-dark overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-heading font-bold text-pop-primary tracking-wide flex items-center gap-2">
                <i class="fa-solid fa-bottle-droplet animate-bounce"></i> MAMACHU
            </a>

            <div class="hidden md:flex space-x-8 font-semibold text-gray-600">
                <a href="#home" class="hover:text-pop-primary transition">Beranda</a>
                <a href="#categories" class="hover:text-pop-primary transition">Kategori</a>
                <a href="#brands" class="hover:text-pop-primary transition">Brand</a>
                <a href="#products" class="hover:text-pop-primary transition">Unggulan</a>
                <a href="#about" class="hover:text-pop-primary transition">Tentang</a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="relative text-gray-600 hover:text-pop-primary transition group">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-pop-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center group-hover:scale-110 transition">3</span>
                </a>
                <a href="{{ route('login') }}" class="bg-pop-primary text-white px-5 py-2 rounded-full font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-red-200">
                    Masuk
                </a>
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-2xl text-pop-dark focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t absolute w-full shadow-lg">
            <div class="flex flex-col px-6 py-4 space-y-4 font-semibold text-lg">
                <a href="#home" class="hover:text-pop-primary">Beranda</a>
                <a href="#categories" class="hover:text-pop-primary">Kategori</a>
                <a href="#brands" class="hover:text-pop-primary">Brand</a>
                <a href="#products" class="hover:text-pop-primary">Unggulan</a>
                <a href="#about" class="hover:text-pop-primary">Tentang</a>
                <hr class="border-gray-200">
                <a href="#" class="flex items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-cart-shopping"></i> Keranjang (3)
                </a>
                <a href="#" class="block text-center bg-pop-primary text-white py-2 rounded-full">Masuk / Daftar</a>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-pop-dark text-white pt-16 pb-8 rounded-t-[3rem] mt-10">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-10">
                <a href="#" class="inline-flex items-center gap-2 text-4xl font-heading font-bold text-white tracking-wide hover:text-pop-primary transition duration-300">
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
                    <a href="#" class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i class="fa-brands fa-instagram text-xl"></i></a>
                    <a href="#" class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i class="fa-brands fa-twitter text-xl"></i></a>
                    <a href="#" class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i class="fa-brands fa-facebook-f text-xl"></i></a>
                    <a href="#" class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-pop-primary hover:scale-110 transition shadow-lg"><i class="fa-solid fa-envelope text-xl"></i></a>
                </div>

                <div class="flex items-center gap-3 bg-gray-800/50 px-6 py-3 rounded-full">
                    <i class="fa-solid fa-phone text-pop-primary text-lg"></i>
                    <span>+62 812 3456 7890</span>
                </div>
            </div>

            <div class="mt-12 text-gray-600 text-xs">
                <p>&copy; 2024 Mamachu Inc. All rights reserved. Dibuat dengan <i class="fa-solid fa-heart text-red-500 mx-1"></i> dan Soda.</p>
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

        // Add to Cart Alert Function
        function addToCart(productName) {
            const notif = document.createElement('div');
            notif.className = 'fixed bottom-5 right-5 bg-pop-dark text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3 transform translate-y-20 transition-all duration-300 z-50';
            notif.innerHTML = `<i class="fa-solid fa-circle-check text-green-400"></i> <span><b>${productName}</b> masuk keranjang!</span>`;

            document.body.appendChild(notif);

            setTimeout(() => { notif.classList.remove('translate-y-20'); }, 100);
            setTimeout(() => {
                notif.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => notif.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>
