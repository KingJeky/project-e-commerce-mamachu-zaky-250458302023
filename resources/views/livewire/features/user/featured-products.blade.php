<div>
    {{-- Hero Section --}}
    <section id="featured-hero" class="pt-32 pb-12 md:pt-40 md:pb-16 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6 text-center">
            <span
                class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-6 shadow-sm">
                ⭐ Pilihan Terbaik
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold leading-tight text-pop-dark mb-6">
                Produk <span class="text-pop-primary relative inline-block">
                    Unggulan
                    <svg class="absolute -bottom-2 left-0 w-full" height="10" viewBox="0 0 100 10"
                        preserveAspectRatio="none">
                        <path d="M0 5 Q 25 10 50 5 Q 75 0 100 5" stroke="#FFD93D" stroke-width="4" fill="none" />
                    </svg>
                </span> Minggu Ini
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                Produk-produk pilihan terbaik yang paling banyak diminati pelanggan kami minggu ini.
            </p>
        </div>
    </section>

    {{-- Featured Products Section --}}
    <section id="all-featured" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-3xl p-5 relative group hover:shadow-2xl transition duration-500
                           border-2 border-gray-100 hover:border-pop-primary h-full flex flex-col">

                            <div
                                class="h-60 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-gray-50 relative">
                                @if (!empty($product->images))
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}"
                                        class="h-full w-full object-cover relative z-10 group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-sm">No Image</span>
                                    </div>
                                @endif

                                {{-- Featured Badge --}}
                                <div
                                    class="absolute top-3 right-3 bg-pop-secondary text-pop-dark px-3 py-1 rounded-full text-xs font-bold shadow-lg z-20">
                                    <i class="fa-solid fa-star mr-1"></i> Unggulan
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm font-bold uppercase mb-2">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </p>
                            <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2 leading-tight">
                                {{ $product->name }}
                            </h3>

                            <div class="mt-auto pt-4">
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-2xl font-black text-pop-primary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    {{-- <a href="#"
                                        class="bg-pop-dark text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pop-primary hover:scale-110 transition shadow-lg">
                                        <i class="fa-solid fa-cart-plus text-lg"></i>
                                    </a> --}}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-xl">Belum ada produk unggulan saat ini.</p>
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
                    <i class="fa-solid fa-star text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">{{ $products->count() }}+</h3>
                    <p class="text-white/90 font-medium">Produk Unggulan</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-fire text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">Populer</h3>
                    <p class="text-white/90 font-medium">Paling Dicari</p>
                </div>
                <div class="flex flex-col items-center">
                    <i class="fa-solid fa-thumbs-up text-5xl mb-4 text-pop-secondary"></i>
                    <h3 class="text-4xl font-black mb-2">Terjamin</h3>
                    <p class="text-white/90 font-medium">Kualitas Terbaik</p>
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
