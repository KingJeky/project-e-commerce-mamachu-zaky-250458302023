<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mamachu</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
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
        .float-anim {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="font-body bg-gradient-to-br from-pop-light via-white to-blue-50 min-h-screen">

    <div class="min-h-screen flex">

        <!-- Left Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12 slide-in">
            <div class="w-full max-w-md">

                <!-- Logo -->
                <a href="/" class="inline-flex items-center gap-2 mb-8 hover:scale-105 transition">
                    <i class="fa-solid fa-bottle-droplet text-pop-primary text-4xl animate-bounce"></i>
                    <span class="text-3xl font-heading font-bold text-pop-primary">MAMACHU</span>
                </a>

                <!-- Title -->
                <div class="mb-8">
                    <h1 class="text-4xl font-heading font-bold text-pop-dark mb-2">Yuk, Gabung! 🚀</h1>
                    <p class="text-gray-600 text-lg">Buat akun dan nikmati berbagai minuman segar favoritmu</p>
                </div>

                <!-- Register Form -->
                <form wire:submit.prevent="register" class="space-y-5">

                    <!-- Name Input -->
                    <div>
                        <label class="block text-sm font-semibold text-pop-dark mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-gray-400"></i>
                            </div>
                            <input type="text" wire:model="name"
                                class="w-full pl-12 pr-4 py-3 border-2 rounded-xl focus:border-pop-primary focus:ring-2 focus:ring-pop-primary/20 outline-none transition @error('name') border-red-500 @enderror"
                                placeholder="Nama kamu">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-pop-dark mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" wire:model="email"
                                class="w-full pl-12 pr-4 py-3 border-2 rounded-xl focus:border-pop-primary focus:ring-2 focus:ring-pop-primary/20 outline-none transition @error('email') border-red-500 @enderror"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-sm font-semibold text-pop-dark mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" wire:model="password"
                                class="w-full pl-12 pr-4 py-3 border-2 rounded-xl focus:border-pop-primary focus:ring-2 focus:ring-pop-primary/20 outline-none transition @error('password') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Confirmation Input -->
                    <div>
                        <label class="block text-sm font-semibold text-pop-dark mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" wire:model="password_confirmation"
                                class="w-full pl-12 pr-4 py-3 border-2 rounded-xl focus:border-pop-primary focus:ring-2 focus:ring-pop-primary/20 outline-none transition"
                                placeholder="Ketik ulang password">
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-pop-accent to-blue-500 text-white font-heading font-semibold py-4 rounded-xl hover:shadow-2xl hover:shadow-pop-accent/50 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Daftar Sekarang</span>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="text-pop-accent font-semibold hover:text-blue-500 transition">
                            Masuk di sini
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <!-- Right Side - Decorative -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-pop-accent via-blue-400 to-pop-secondary items-center justify-center p-12 relative overflow-hidden">

            <!-- Floating Bottles -->
            <div class="absolute top-20 right-20 text-white/20 text-9xl float-anim">
                <i class="fa-solid fa-bottle-droplet"></i>
            </div>
            <div class="absolute bottom-20 left-20 text-white/20 text-7xl float-anim" style="animation-delay: 1s;">
                <i class="fa-solid fa-glass-water"></i>
            </div>

            <!-- Content -->
            <div class="relative z-10 text-white text-center max-w-md">
                <div class="mb-8">
                    <div
                        class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                        <i class="fa-solid fa-gift text-6xl"></i>
                    </div>
                    <h2 class="text-5xl font-heading font-bold mb-6">Bonus untuk Member Baru! 🎁</h2>
                    <p class="text-xl mb-8 text-white/90">
                        Daftar sekarang dan dapatkan voucher diskon 20% untuk pembelian pertama!
                    </p>
                </div>

                <!-- Benefits -->
                <div class="space-y-4 text-left">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-check text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Akses ke ribuan produk minuman</h3>
                            <p class="text-sm text-white/80">Dari jus segar hingga minuman kekinian</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-check text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Promo eksklusif member</h3>
                            <p class="text-sm text-white/80">Diskon spesial setiap minggu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-check text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Gratis ongkir untuk member</h3>
                            <p class="text-sm text-white/80">Minimal pembelian Rp 50.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
