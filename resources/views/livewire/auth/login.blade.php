<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mamachu</title>

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

        /* Fix for Chrome/Safari autofill background and text color */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-text-fill-color: #ffffff !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="font-body bg-gradient-to-br from-pop-light via-white to-blue-50 min-h-screen">

    <div class="min-h-screen flex">

        <!-- Left Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12 slide-in">
            <div class="w-full max-w-md">

                <!-- Logo -->
                <a href="/" class="inline-flex items-center gap-2 mb-8 hover:scale-105 transition">
                    <i class="fa-solid fa-bottle-droplet text-pop-primary text-4xl animate-bounce"></i>
                    <span class="text-3xl font-heading font-bold text-pop-primary">MAMACHU</span>
                </a>

                <!-- Title -->
                <div class="mb-8">
                    <h1 class="text-4xl font-heading font-bold text-black mb-2">Selamat Datang! 👋</h1>
                    <p class="text-gray-600 text-lg">Masuk untuk melanjutkan petualangan rasamu</p>
                </div>

                <!-- Login Form -->
                <form wire:submit.prevent="login" class="space-y-5">

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
                                placeholder="Masukkan password kamu">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="remember"
                                class="w-4 h-4 rounded border-gray-300 text-pop-primary focus:ring-pop-primary">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        {{-- <a href="#" class="text-sm text-pop-accent font-semibold hover:text-blue-500 transition">
                            Lupa password?
                        </a> --}}
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-pop-primary to-orange-500 text-white font-heading font-semibold py-4 rounded-xl hover:shadow-2xl hover:shadow-pop-primary/50 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Masuk Sekarang</span>
                    </button>
                </form>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                            class="text-pop-accent font-semibold hover:text-blue-500 transition">
                            Daftar di sini
                        </a>
                    </p>
                </div>

            </div>
        </div>

        <!-- Right Side - Decorative -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-pop-primary via-orange-400 to-pop-secondary items-center justify-center p-12 relative overflow-hidden">

            <!-- Floating Bottles -->
            <div class="absolute top-20 right-20 text-white/20 text-9xl float-anim">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <div class="absolute bottom-20 left-20 text-white/20 text-7xl float-anim" style="animation-delay: 1s;">
                <i class="fa-solid fa-ice-cream"></i>
            </div>

            <!-- Content -->
            <div class="relative z-10 text-white text-center max-w-md">
                <div class="mb-8">
                    <div
                        class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                        <i class="fa-solid fa-heart text-6xl"></i>
                    </div>
                    <h2 class="text-5xl font-heading font-bold mb-6">Senang Bertemu Lagi! ❤️</h2>
                    <p class="text-xl mb-8 text-white/90">
                        Siap untuk menikmati minuman favoritmu hari ini?
                    </p>
                </div>

                <!-- Benefits -->
                <div class="space-y-4 text-left">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-star text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Lanjutkan pesananmu</h3>
                            <p class="text-sm text-white/80">Riwayat pesanan tersimpan aman</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-tag text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Cek promo terbaru</h3>
                            <p class="text-sm text-white/80">Jangan lewatkan penawaran spesial</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
