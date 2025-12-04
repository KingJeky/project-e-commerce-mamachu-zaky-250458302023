<div>
    {{-- Breadcrumb with Back Button --}}
    <section class="pt-32 pb-8">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-4">
                <nav class="flex items-center gap-2 text-sm text-gray-600">
                    <a href="{{ route('home') }}" class="hover:text-pop-primary transition">Beranda</a>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                    <a href="{{ route('user.main') }}" class="hover:text-pop-primary transition">Produk</a>
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                    <span class="text-pop-primary font-semibold">{{ $product->name }}</span>
                </nav>

                {{-- Back to Main Button --}}
                <a href="{{ route('user.main') }}"
                    class="bg-white hover:bg-pop-light border-2 border-gray-200 hover:border-pop-primary text-gray-700 hover:text-pop-primary px-6 py-2 rounded-full font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali Belanja
                </a>
            </div>
        </div>
    </section>

    {{-- Product Detail Section --}}
    <section class="pb-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Product Images with Slider --}}
                <div class="space-y-4">
                    {{-- Main Image Display with Navigation --}}
                    <div class="relative bg-gray-50 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                        @if (!empty($product->images))
                            @foreach ($product->images as $index => $image)
                                <img id="main-image-{{ $index }}" src="{{ asset('storage/' . $image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-[500px] object-cover {{ $index === 0 ? '' : 'hidden' }}"
                                    data-image-index="{{ $index }}">
                            @endforeach

                            {{-- Navigation Arrows --}}
                            @if (count($product->images) > 1)
                                <button onclick="previousImage()"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition hover:scale-110">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <button onclick="nextImage()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition hover:scale-110">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>

                                {{-- Image Counter --}}
                                <div
                                    class="absolute bottom-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <span id="current-image">1</span> / {{ count($product->images) }}
                                </div>
                            @endif
                        @else
                            <img src="https://via.placeholder.com/600" alt="{{ $product->name }}"
                                class="w-full h-[500px] object-cover">
                        @endif
                    </div>

                    {{-- Thumbnail Images --}}
                    @if (!empty($product->images) && count($product->images) > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($product->images as $index => $image)
                                <div onclick="showImage({{ $index }})"
                                    class="thumbnail bg-gray-50 rounded-2xl overflow-hidden border-2 {{ $index === 0 ? 'border-pop-primary' : 'border-gray-200' }} hover:border-pop-primary transition cursor-pointer"
                                    data-thumb-index="{{ $index }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="w-full h-24 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="flex flex-col">
                    {{-- Badges --}}
                    <div class="flex items-center gap-3 mb-4">
                        @if ($product->is_featured)
                            <span class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold">
                                <i class="fa-solid fa-star mr-1"></i> Unggulan
                            </span>
                        @endif
                        @if ($product->in_stock)
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                <i class="fa-solid fa-check-circle mr-1"></i> Stok Tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
                                <i class="fa-solid fa-times-circle mr-1"></i> Stok Habis
                            </span>
                        @endif
                    </div>

                    {{-- Product Name --}}
                    <h1 class="text-4xl lg:text-5xl font-heading font-bold text-pop-dark mb-3">
                        {{ $product->name }}
                    </h1>

                    {{-- Category & Brand --}}
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-gray-600">
                            <i class="fa-solid fa-layer-group mr-2 text-pop-primary"></i>
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                        @if ($product->brand)
                            <span class="text-gray-600">
                                <i class="fa-solid fa-certificate mr-2 text-pop-primary"></i>
                                {{ $product->brand->name }}
                            </span>
                        @endif
                    </div>

                    {{-- Price --}}
                    <div class="bg-gradient-to-r from-pop-primary to-red-500 rounded-3xl p-6 mb-8">
                        <p class="text-white text-sm font-semibold mb-2">Harga</p>
                        <p class="text-white text-4xl font-black">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Description --}}
                    @if ($product->description)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Produk</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif

                    {{-- Quantity Selector --}}
                    <div class="mb-8">
                        <label class="text-lg font-bold text-gray-800 mb-3 block">Jumlah</label>
                        <div class="flex items-center gap-4">
                            <button wire:click="decrementQuantity"
                                class="w-12 h-12 rounded-full bg-gray-200 hover:bg-gray-300 transition flex items-center justify-center">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <span class="text-2xl font-bold text-pop-dark w-16 text-center">{{ $quantity }}</span>
                            <button wire:click="incrementQuantity"
                                class="w-12 h-12 rounded-full bg-gray-200 hover:bg-gray-300 transition flex items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Add to Cart Button --}}
                    <div class="flex gap-4">
                        <button wire:click="addToCart" @if (!$product->in_stock) disabled @endif
                            class="flex-1 bg-pop-primary hover:bg-red-500 disabled:bg-gray-400 disabled:cursor-not-allowed text-white px-8 py-5 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <i class="fa-solid fa-cart-plus text-xl"></i>
                            Masukkan ke Keranjang
                        </button>
                    </div>

                    {{-- Info --}}
                    <div class="mt-8 bg-pop-light rounded-3xl p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-pop-primary"></i>
                            Informasi Penting
                        </h4>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-600 mt-1"></i>
                                <span>Produk original dan berkualitas</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-600 mt-1"></i>
                                <span>Dikirim dalam kondisi dingin</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-600 mt-1"></i>
                                <span>Garansi uang kembali jika produk rusak</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        let currentImageIndex = 0;
        const totalImages = document.querySelectorAll('[data-image-index]').length;

        function showImage(index) {
            // Hide all images
            document.querySelectorAll('[data-image-index]').forEach(img => {
                img.classList.add('hidden');
            });

            // Show selected image
            document.getElementById('main-image-' + index).classList.remove('hidden');

            // Update thumbnails border
            document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.remove('border-gray-200');
                    thumb.classList.add('border-pop-primary');
                } else {
                    thumb.classList.add('border-gray-200');
                    thumb.classList.remove('border-pop-primary');
                }
            });

            // Update counter
            const counter = document.getElementById('current-image');
            if (counter) {
                counter.textContent = index + 1;
            }

            currentImageIndex = index;
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % totalImages;
            showImage(currentImageIndex);
        }

        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
            showImage(currentImageIndex);
        }

        // Livewire event listener and hooks
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
                });
            });

            // Preserve slider state across Livewire updates
            let savedSliderIndex = 0;

            // Before Livewire updates the DOM, save the current slider position
            Livewire.hook('commit', ({
                component,
                commit,
                respond
            }) => {
                savedSliderIndex = currentImageIndex;
            });

            // After Livewire updates the DOM, restore the slider position
            Livewire.hook('morph.updated', ({
                el,
                component
            }) => {
                // Small delay to ensure DOM is fully updated
                setTimeout(() => {
                    if (savedSliderIndex !== undefined && savedSliderIndex !== 0) {
                        showImage(savedSliderIndex);
                    }
                }, 10);
            });
        });
    </script>
@endpush
