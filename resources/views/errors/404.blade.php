<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Mamachu</title>

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

        .bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .bubble {
            animation: bubble 8s ease-in-out infinite;
        }

        @keyframes bubble {

            0%,
            100% {
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-30px) scale(1.1);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="font-body bg-gradient-to-br from-pop-light via-white to-blue-50 text-pop-dark overflow-hidden">

    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <!-- Floating Bottles -->
        <i class="fa-solid fa-bottle-droplet text-pop-primary/10 text-9xl absolute top-20 left-10 float-anim"></i>
        <i class="fa-solid fa-glass-water text-pop-accent/10 text-7xl absolute bottom-20 right-20 bounce-slow"
            style="animation-delay: 1s;"></i>

        <!-- Bubbles -->
        <div class="absolute top-40 right-40 w-20 h-20 bg-pop-secondary/20 rounded-full bubble"></div>
        <div class="absolute bottom-40 left-40 w-16 h-16 bg-pop-accent/20 rounded-full bubble"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-60 left-1/3 w-12 h-12 bg-pop-primary/20 rounded-full bubble"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-3xl w-full text-center">

            <!-- 404 Number -->
            <div class="mb-8 relative">
                <h1
                    class="text-[200px] md:text-[280px] font-heading font-bold text-transparent bg-clip-text bg-gradient-to-r from-pop-primary via-pop-secondary to-pop-accent leading-none select-none">
                    404
                </h1>
                <!-- Floating icon in the middle of 4 and 4 -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <i class="fa-solid fa-face-sad-tear text-7xl md:text-9xl text-pop-dark/80 float-anim"></i>
                </div>
            </div>

            <!-- Message -->
            <div class="space-y-4 mb-10">
                <h2 class="text-3xl md:text-5xl font-heading font-bold text-pop-dark">
                    Ups! Minumannya Hilang
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Sepertinya halaman yang kamu cari sudah tumpah atau tersesat di gudang.
                    Mari kembali ke halaman sebelumnya!
                </p>
            </div>

            <!-- Action Button -->
            <div class="flex justify-center">
                <button onclick="window.history.back()"
                    class="group bg-gradient-to-r from-pop-primary to-red-500 text-white px-10 py-5 rounded-full font-heading font-semibold text-xl hover:shadow-2xl hover:shadow-pop-primary/50 hover:scale-105 transition-all duration-300 flex items-center gap-3">
                    <i class="fa-solid fa-arrow-left text-2xl group-hover:animate-pulse"></i>
                    <span>Kembali ke Halaman Sebelumnya</span>
                </button>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div
        class="fixed bottom-0 left-0 right-0 p-4 text-center bg-gradient-to-t from-white/80 to-transparent backdrop-blur-sm">
        <div class="flex items-center justify-center gap-2 text-gray-600">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-bottle-droplet text-pop-primary"></i>
                <span class="font-heading font-bold text-xl">MAMACHU</span>
            </div>
            <span class="text-gray-400">|</span>
            <span class="text-sm">Segarkan Harimu!</span>
        </div>
    </div>

</body>

</html>
