<x-layouts.app title="Mamachu - Home">

    <section id="home" class="pt-32 pb-20 md:pt-44 md:pb-32 relative overflow-hidden">
        <div class="container mx-auto px-6 flex flex-col-reverse md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left z-10 mt-12 md:mt-0">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-6 shadow-sm">
                    🥤 #1 E-Commerce Minuman
                </span>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold leading-tight text-pop-dark mb-6">
                    Temukan <span class="text-pop-primary relative inline-block">
                        Kesegaran
                        <svg class="absolute -bottom-2 left-0 w-full" height="10" viewBox="0 0 100 10"
                            preserveAspectRatio="none">
                            <path d="M0 5 Q 25 10 50 5 Q 75 0 100 5" stroke="#FFD93D" stroke-width="4" fill="none" />
                        </svg>
                    </span> <br> Favoritmu Disini!
                </h1>
                <p class="text-gray-600 text-lg mb-8 md:pr-12 leading-relaxed">
                    Mamachu menghadirkan ribuan pilihan minuman menyegarkan. Dari soda pop yang menggelitik lidah hingga
                    jus buah alami, semua siap diantar dingin ke tempatmu.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#products"
                        class="bg-pop-primary hover:bg-red-500 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center justify-center">
                        Belanja Sekarang <i class="fa-solid fa-cart-flatbed ml-3"></i>
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-center relative z-10">
                <div class="relative w-full max-w-lg">
                    <img src="https://images.unsplash.com/photo-1527960669566-f882ba85a4c6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Minuman Segar"
                        class="relative z-10 w-full h-auto object-cover rounded-[3rem] shadow-2xl float-anim border-4 border-white">
                </div>
            </div>
        </div>
    </section>

    <section id="brands" class="py-24 bg-white border-y border-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-pop-dark mb-4">Partner <span
                        class="text-pop-primary">Brand</span></h2>
                <p class="text-gray-600 max-w-xl mx-auto">Kami bekerja sama dengan brand minuman terbaik dunia.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-red-500 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md bg-white flex items-center justify-center border-4 border-red-100 group-hover:rotate-6 transition">
                            <img src="https://via.placeholder.com/100x100?text=COLA" alt="Brand 1"
                                class="w-full h-full object-contain opacity-80 p-2">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Coca Cola</h3>
                        <p class="text-sm text-gray-500 bg-red-50 inline-block px-3 py-1 rounded-full">Official Partner
                        </p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-blue-500 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md bg-white flex items-center justify-center border-4 border-blue-100 group-hover:rotate-6 transition">
                            <img src="https://via.placeholder.com/100x100?text=PEPSI" alt="Brand 2"
                                class="w-full h-full object-contain opacity-80 p-2">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Pepsi</h3>
                        <p class="text-sm text-gray-500 bg-blue-50 inline-block px-3 py-1 rounded-full">Official Partner
                        </p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-green-500 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md bg-white flex items-center justify-center border-4 border-green-100 group-hover:rotate-6 transition">
                            <img src="https://via.placeholder.com/100x100?text=SPRITE" alt="Brand 3"
                                class="w-full h-full object-contain opacity-80 p-2">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Sprite</h3>
                        <p class="text-sm text-gray-500 bg-green-50 inline-block px-3 py-1 rounded-full">Official
                            Partner</p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-orange-500 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md bg-white flex items-center justify-center border-4 border-orange-100 group-hover:rotate-6 transition">
                            <img src="https://via.placeholder.com/100x100?text=FANTA" alt="Brand 4"
                                class="w-full h-full object-contain opacity-80 p-2">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Fanta</h3>
                        <p class="text-sm text-gray-500 bg-orange-50 inline-block px-3 py-1 rounded-full">Official
                            Partner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="categories" class="py-24 bg-pop-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-pop-dark mb-4">Kategori <span
                        class="text-pop-primary">Pilihan</span></h2>
                <p class="text-gray-600 max-w-xl mx-auto">Pilih jenis minuman yang sesuai dengan mood kamu hari ini.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-pop-primary cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?auto=format&fit=crop&w=200&h=200&q=80"
                                alt="Soda Icon" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Soda Pop</h3>
                        <p class="text-sm text-gray-500 bg-red-50 inline-block px-3 py-1 rounded-full">120+ Varian</p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-green-400 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1597481499750-3e6b22637e12?auto=format&fit=crop&w=200&h=200&q=80"
                                alt="Tea Icon" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Teh & Organik</h3>
                        <p class="text-sm text-gray-500 bg-green-50 inline-block px-3 py-1 rounded-full">85+ Varian</p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-orange-400 cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&w=200&h=200&q=80"
                                alt="Juice Icon" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Jus Buah Asli</h3>
                        <p class="text-sm text-gray-500 bg-orange-50 inline-block px-3 py-1 rounded-full">90+ Varian
                        </p>
                    </div>
                </div>
                <div
                    class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 text-center border-2 border-transparent hover:border-pop-secondary cursor-pointer relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=200&h=200&q=80"
                                alt="Coffee Icon" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Kopi & Susu</h3>
                        <p class="text-sm text-gray-500 bg-yellow-50 inline-block px-3 py-1 rounded-full">50+ Varian
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="products"
        class="py-24 bg-white rounded-t-[4rem] -mt-12 z-10 relative shadow-[0_-10px_30px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-4xl font-heading font-bold text-pop-dark">Produk <span
                            class="text-pop-primary">Unggulan</span></h2>
                    <p class="text-gray-500 mt-2 text-lg">Paling banyak dicari minggu ini di Mamachu!</p>
                </div>
                <a href="#"
                    class="hidden md:inline-flex items-center gap-2 text-pop-primary font-bold hover:underlineBg-pop-secondary px-6 py-3 rounded-full hover:bg-pop-secondary/20 transition">
                    Lihat Semua Produk <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500 border-2 border-gray-100 hover:border-pop-primary h-full flex flex-col">
                    <div
                        class="absolute top-5 left-5 bg-pop-secondary text-pop-dark text-xs font-bold px-3 py-1 rounded-full z-20">
                        Terlaris</div>
                    <div
                        class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                        <div
                            class="absolute inset-0 bg-red-100 rounded-2xl transform rotate-3 scale-90 group-hover:rotate-6 transition">
                        </div>
                        <img src="https://images.unsplash.com/photo-1543253687-c59668cb26fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Cola Glass"
                            class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                    </div>
                    <p class="text-gray-400 text-sm font-bold uppercase mb-2">Kategori: Soda</p>
                    <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">Cola Klasik Dingin
                    </h3>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-black text-pop-primary">Rp 8.500</span>
                            <button onclick="addToCart('Cola Klasik')"
                                class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-primary hover:scale-110 transition shadow-lg">
                                <i class="fa-solid fa-cart-plus text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500 border-2 border-gray-100 hover:border-pop-accent h-full flex flex-col">
                    <div
                        class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                        <div
                            class="absolute inset-0 bg-blue-100 rounded-2xl transform -rotate-3 scale-90 group-hover:-rotate-6 transition">
                        </div>
                        <img src="https://images.unsplash.com/photo-1534057308991-b9b3a578f1b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Blue Drink"
                            class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                    </div>
                    <p class="text-gray-400 text-sm font-bold uppercase mb-2">Kategori: Mocktail</p>
                    <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">Blue Ocean Breeze</h3>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-black text-pop-primary">Rp 12.000</span>
                            <button onclick="addToCart('Blue Ocean')"
                                class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-accent hover:scale-110 transition shadow-lg">
                                <i class="fa-solid fa-cart-plus text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500 border-2 border-gray-100 hover:border-orange-400 h-full flex flex-col">
                    <div
                        class="absolute top-5 left-5 bg-pop-primary text-white text-xs font-bold px-3 py-1 rounded-full z-20">
                        Promo -20%</div>
                    <div
                        class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                        <div
                            class="absolute inset-0 bg-orange-100 rounded-2xl transform rotate-3 scale-90 group-hover:rotate-6 transition">
                        </div>
                        <img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Orange Juice"
                            class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                    </div>
                    <p class="text-gray-400 text-sm font-bold uppercase mb-2">Kategori: Jus Buah</p>
                    <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">Jus Jeruk Segar</h3>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                <span class="text-sm text-gray-400 line-through block">Rp 20.000</span>
                                <span class="text-2xl font-black text-pop-primary">Rp 16.000</span>
                            </div>
                            <button onclick="addToCart('Jus Jeruk')"
                                class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-primary transition">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500 border-2 border-gray-100 hover:border-yellow-200 h-full flex flex-col">
                    <div
                        class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                        <div
                            class="absolute inset-0 bg-yellow-100 rounded-2xl transform -rotate-3 scale-90 group-hover:-rotate-6 transition">
                        </div>
                        <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Drink"
                            class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                    </div>
                    <p class="text-gray-400 text-sm font-bold uppercase mb-2">Kategori: Kopi Dingin</p>
                    <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">Matcha Latte</h3>
                    <div class="mt-auto pt-4">
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-black text-pop-primary">Rp 18.500</span>
                            <button onclick="addToCart('Matcha Latte')"
                                class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-primary hover:scale-110 transition shadow-lg">
                                <i class="fa-solid fa-cart-plus text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center md:hidden">
                <a href="#"
                    class="bg-white border border-gray-300 px-6 py-3 rounded-full text-gray-700 font-bold hover:bg-gray-50">Lihat
                    Semua Produk</a>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2 relative">
                    <div class="absolute inset-0 bg-pop-secondary/20 rounded-full filter blur-3xl scale-110"></div>
                    <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Suasana Kafe"
                        class="relative rounded-[3rem] shadow-2xl transform -rotate-2 hover:rotate-0 transition duration-500 border-8 border-white">
                </div>

                <div class="md:w-1/2">
                    <div
                        class="inline-block bg-orange-100 text-orange-600 px-4 py-1 rounded-full font-bold text-sm mb-4">
                        Tentang Kami</div>
                    <h2 class="text-4xl font-heading font-bold text-pop-dark mb-6">Cerita Dibalik <br><span
                            class="text-pop-primary">Mamachu</span></h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Berawal dari kecintaan kami terhadap minuman yang menyegarkan, Mamachu hadir sebagai platform
                        e-commerce no. 1 untuk segala jenis minuman. Kami menghubungkan Anda dengan ribuan brand lokal
                        yang unik dan brand internasional favorit Anda.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-10">
                        Visi kami adalah membuat setiap tegukan menjadi momen kebahagiaan. Dikirim dingin, cepat, dan
                        aman sampai ke tangan Anda.
                    </p>

                    <div class="grid grid-cols-3 gap-8 border-t pt-8 border-gray-100">
                        <div>
                            <h4 class="text-4xl font-black text-pop-primary mb-1">10K+</h4>
                            <p class="text-sm font-semibold text-gray-500">Pelanggan Puas</p>
                        </div>
                        <div>
                            <h4 class="text-4xl font-black text-pop-primary mb-1">50+</h4>
                            <p class="text-sm font-semibold text-gray-500">Kota Dijangkau</p>
                        </div>
                        <div>
                            <h4 class="text-4xl font-black text-pop-primary mb-1">24j</h4>
                            <p class="text-sm font-semibold text-gray-500">Layanan Antar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
