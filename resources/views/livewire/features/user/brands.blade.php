<div>
    {{-- Hero Section --}}
    <section id="brands-hero" class="pt-32 pb-12 md:pt-40 md:pb-16 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6 text-center">
            <span
                class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-6 shadow-sm">
                🏆 Brand Terpercaya
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold leading-tight text-pop-dark mb-6">
                Semua <span class="text-pop-primary relative inline-block">
                    Partner Brand
                    <svg class="absolute -bottom-2 left-0 w-full" height="10" viewBox="0 0 100 10"
                        preserveAspectRatio="none">
                        <path d="M0 5 Q 25 10 50 5 Q 75 0 100 5" stroke="#FFD93D" stroke-width="4" fill="none" />
                    </svg>
                </span> Kami
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                Kami bekerja sama dengan brand-brand minuman terbaik dunia untuk memberikan kualitas terbaik kepada
                Anda.
            </p>
        </div>
    </section>

    {{-- All Brands Section --}}
    <section id="all-brands" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            @if ($brands->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
                    @foreach ($brands as $brand)
                        <div
                            class="group bg-white p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300
                           text-center border-2 border-transparent hover:border-pop-primary cursor-pointer relative overflow-hidden">

                            <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0">
                            </div>

                            <div class="relative z-10">
                                <div
                                    class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden shadow-md group-hover:rotate-6 transition border-4 border-white">

                                    @if ($brand->image)
                                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
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
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-xl">Belum ada brand yang tersedia saat ini.</p>
                </div>
            @endif

            {{-- Continue Shopping Button --}}
            <div class="flex justify-center mt-12">
                @auth
                    <a href="{{ route('user.main') }}"
                        class="bg-pop-primary hover:bg-red-500 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center gap-3 group">
                        <i class="fa-solid fa-cart-flatbed text-xl group-hover:scale-110 transition"></i>
                        Lanjut Belanja
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </a>
                @else
                    <button onclick="showLoginAlert()"
                        class="bg-pop-primary hover:bg-red-500 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center gap-3 group">
                        <i class="fa-solid fa-cart-flatbed text-xl group-hover:scale-110 transition"></i>
                        Lanjut Belanja
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </button>
                @endauth
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-16 bg-gradient-to-br from-pop-primary to-red-500 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-trophy text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">{{ $brands->count() }}+</h3>
                    <p class="text-white/90 font-medium">Brand Partner</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-star text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">100%</h3>
                    <p class="text-white/90 font-medium">Produk Original</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-truck-fast text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">24 Jam</h3>
                    <p class="text-white/90 font-medium">Pengiriman Cepat</p>
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
