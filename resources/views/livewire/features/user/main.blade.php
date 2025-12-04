@push('styles')
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

<div class="container mx-auto px-4 py-8 pt-32">

    <!-- Header Page Title -->
    <div class="text-center mb-10">
        <span
            class="bg-pop-secondary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider text-yellow-900 mb-2 inline-block">Cari
            Kesegaranmu</span>
        <h1 class="text-3xl md:text-4xl font-bold text-pop-dark">Eksplorasi Minuman Favorit</h1>
        <p class="text-gray-500 mt-2">Gunakan filter di bawah untuk menemukan minuman yang pas buat kamu.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- SIDEBAR FILTER (Kiri) -->
        <aside class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg"><i class="fa-solid fa-filter mr-2 text-pop-primary"></i> Filter</h3>
                    <button wire:click="resetFilters"
                        class="text-xs text-gray-400 hover:text-pop-primary underline">Reset Semua</button>
                </div>

                <!-- Filter Harga -->
                <div class="mb-6 border-b border-gray-100 pb-6" wire:ignore>
                    <label for="priceRange" class="block text-sm font-semibold mb-3">Maksimal Harga</label>
                    <input type="range" id="priceRange" min="0" max="{{ $initialMaxPrice }}" step="500"
                        value="{{ $maxPrice }}"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-pop-primary">
                    <div class="flex justify-between text-sm mt-2 font-medium text-gray-600">
                        <span>Rp 0</span>
                        <span id="priceValue" class="text-pop-primary">Rp
                            {{ number_format($maxPrice, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Filter Kategori -->
                <div class="mb-6 border-b border-gray-100 pb-6">
                    <h4 class="text-sm font-semibold mb-3">Kategori</h4>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <div class="flex items-center">
                                <input id="cat-{{ $category->id }}" type="checkbox" value="{{ $category->id }}"
                                    wire:model.live="selectedCategories"
                                    class="w-4 h-4 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2">
                                <label for="cat-{{ $category->id }}"
                                    class="ml-2 text-sm text-gray-700 cursor-pointer hover:text-pop-primary">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Filter Brand -->
                <div class="mb-2">
                    <h4 class="text-sm font-semibold mb-3">Brand</h4>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-2">
                        @foreach ($brands as $brand)
                            <div class="flex items-center">
                                <input id="brand-{{ $brand->id }}" type="checkbox" value="{{ $brand->id }}"
                                    wire:model.live="selectedBrands"
                                    class="w-4 h-4 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2">
                                <label for="brand-{{ $brand->id }}"
                                    class="ml-2 text-sm text-gray-700 cursor-pointer hover:text-pop-primary">{{ $brand->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        <!-- PRODUCT GRID AREA (Kanan) -->
        <main class="w-full lg:w-3/4">

            <!-- Search Bar Besar -->
            <div class="relative mb-8">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 text-lg"></i>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="block w-full pl-12 pr-4 py-4 rounded-2xl border-none shadow-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pop-primary focus:shadow-lg transition text-lg"
                    placeholder="Cari nama minuman, rasa, atau brand...">
            </div>

            <!-- Info Hasil Pencarian -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">Menampilkan <span
                        class="font-bold text-pop-dark">{{ $products->total() }}</span> produk</p>

                <select wire:model.live="sortBy"
                    class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-pop-primary focus:border-pop-primary block p-2.5 outline-none">
                    <option value="default">Urutkan: Terbaru</option>
                    <option value="low">Harga: Terendah</option>
                    <option value="high">Harga: Tertinggi</option>
                    <option value="az">Nama: A-Z</option>
                </select>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group fade-in flex flex-col">
                        <a href="{{ route('product.detail', $product->slug) }}" class="block">
                            <div class="relative overflow-hidden h-48 bg-gray-100">
                                @if ($product->images)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                @endif
                                <span
                                    class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold px-2 py-1 rounded-lg text-gray-600">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                        </a>
                        <div class="p-5 flex flex-col flex-grow">
                            <a href="{{ route('product.detail', $product->slug) }}" class="block">
                                <div class="flex justify-between items-start mb-2">
                                    <span
                                        class="text-xs text-pop-primary font-bold uppercase tracking-wide">{{ $product->brand->name }}</span>
                                </div>
                                <h3
                                    class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-pop-primary transition">
                                    {{ $product->name }}</h3>
                            </a>
                            <div class="mt-auto pt-4 flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                <button wire:click="addToCart('{{ $product->id }}')"
                                    class="w-10 h-10 rounded-full bg-red-50 text-pop-primary flex items-center justify-center hover:bg-pop-primary hover:text-white transition">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-50 mb-4">
                            <i class="fa-solid fa-mug-hot text-3xl text-pop-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Yah, Produk tidak ditemukan!</h3>
                        <p class="text-gray-500 mt-2">Coba ganti kata kunci atau atur ulang filter kamu.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(number);
            }

            priceRange.addEventListener('input', (e) => {
                priceValue.textContent = formatRupiah(e.target.value);
            });

            priceRange.addEventListener('change', (e) => {
                @this.set('maxPrice', e.target.value);
            });

            Livewire.on('reset-price-slider', () => {
                priceRange.value = {{ $initialMaxPrice }};
                priceValue.textContent = formatRupiah({{ $initialMaxPrice }});
            });

            // SweetAlert event listeners
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

            Livewire.on('swal:error', (event) => {
                const {
                    title,
                    text
                } = event;
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: text,
                });
            });
        });
    </script>
@endpush
