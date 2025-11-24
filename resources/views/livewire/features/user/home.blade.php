<div>
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
                    @auth
                        <a href="{{ route('user.main') }}"
                            class="bg-pop-primary hover:bg-red-500 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center justify-center">
                            Belanja Sekarang <i class="fa-solid fa-cart-flatbed ml-3"></i>
                        </a>
                    @else
                        <button onclick="showLoginAlert()"
                            class="bg-pop-primary hover:bg-red-500 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center justify-center">
                            Belanja Sekarang <i class="fa-solid fa-cart-flatbed ml-3"></i>
                        </button>
                    @endauth
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
                <h2 class="text-4xl font-heading font-bold text-pop-dark mb-4">
                    Partner <span class="text-pop-primary">Brand</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">Kami bekerja sama dengan brand minuman terbaik dunia.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                @forelse ($brands as $brand)
                    <div
                        class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300
                       text-center border-2 border-transparent hover:border-red-500 cursor-pointer relative overflow-hidden">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>

                        <div class="relative z-10">

                            <!-- FIXED: Ikuti style kategori -->
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">

                                @if ($brand->image)
                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-xs text-center">No Image</span>
                                    </div>
                                @endif

                            </div>

                            <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $brand->name }}</h3>
                            <p class="text-sm text-gray-500 bg-red-50 inline-block px-3 py-1 rounded-full">Official
                                Partner</p>
                        </div>

                    </div>
                @empty
                    <p class="text-center col-span-4 text-gray-600">No brands found.</p>
                @endforelse
            </div>
        </div>
    </section>



    <section id="categories" class="py-24 bg-pop-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-pop-dark mb-4">
                    Kategori <span class="text-pop-primary">Pilihan</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">
                    Pilih jenis minuman yang sesuai dengan mood kamu hari ini.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">

                @forelse ($categories as $category)
                    <div
                        class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300
                           text-center border-2 border-transparent hover:border-pop-primary cursor-pointer relative overflow-hidden">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>

                        <div class="relative z-10">
                            <div
                                class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">

                                <img src="{{ asset('storage/' . $category->image) }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500 bg-red-50 inline-block px-3 py-1 rounded-full">
                                {{ $category->products_count ?? '0' }} Produk
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-600">No categories found.</p>
                @endforelse

            </div>
        </div>
    </section>


    <section id="products"
        class="py-24 bg-white rounded-t-[4rem] -mt-12 z-10 relative shadow-[0_-10px_30px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto px-6">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-heading font-bold text-pop-dark mb-4">
                    Produk <span class="text-pop-primary">Unggulan</span>
                </h2>
                <p class="text-gray-600 max-w-xl mx-auto">Paling banyak dicari minggu ini di Mamachu!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @forelse($products as $product)
                    <div
                        class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500
                           border-2 border-gray-100 hover:border-pop-primary h-full flex flex-col">

                        <div
                            class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                            @if (!empty($product->images))
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                            @endif
                        </div>

                        <p class="text-gray-400 text-sm font-bold uppercase mb-2">Kategori:
                            {{ $product->category->name }}
                        <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-auto pt-4">
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-black text-pop-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                {{-- {{ route('product.show', $product->slug) }} --}}
                                <a href="#"
                                    class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-primary hover:scale-110 transition shadow-lg">
                                    <i class="fa-solid fa-cart-plus text-lg"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-600">No products found.</p>
                @endforelse

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
</div>

@push('scripts')
    <script>
        function showLoginAlert() {
            Swal.fire({
                title: 'Login Diperlukan',
                text: 'Silakan login terlebih dahulu untuk mulai berbelanja!',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#FF6B6B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-right-to-bracket mr-2"></i> Login Sekarang',
                cancelButtonText: 'Nanti Saja',
                reverseButtons: true,
                customClass: {
                    popup: 'font-body',
                    title: 'font-heading',
                    confirmButton: 'font-semibold',
                    cancelButton: 'font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('login') }}';
                }
            });
        }
    </script>
@endpush
