<div>
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-4 shadow-sm">
                    <i class="fa-solid fa-shopping-cart mr-2"></i> Keranjang Belanja
                </span>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-4">
                    Keranjang <span class="text-pop-primary">Anda</span>
                </h1>
                <p class="text-gray-600 text-lg">Kelola produk yang ingin Anda beli</p>
            </div>
        </div>
    </section>

    {{-- Cart Content --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            @if ($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Cart Items --}}
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($cartItems as $item)
                            <div
                                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                                <div class="flex gap-6">
                                    {{-- Product Image --}}
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100">
                                            @if (!empty($item->product->images))
                                                <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                    alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fa-solid fa-image text-gray-400 text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Product Info --}}
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-bold text-lg text-gray-800 mb-1">
                                                    {{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ $item->product->category->name ?? 'Uncategorized' }}
                                                    @if ($item->product->brand)
                                                        • {{ $item->product->brand->name }}
                                                    @endif
                                                </p>
                                            </div>
                                            <button wire:click="removeItem({{ $item->id }})"
                                                class="text-red-500 hover:text-red-700 transition">
                                                <i class="fa-solid fa-trash text-lg"></i>
                                            </button>
                                        </div>

                                        <div class="flex justify-between items-center mt-4">
                                            {{-- Quantity Controls --}}
                                            <div class="flex items-center gap-3">
                                                <button
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                    class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 transition flex items-center justify-center">
                                                    <i class="fa-solid fa-minus text-sm"></i>
                                                </button>
                                                <span
                                                    class="text-lg font-bold text-pop-dark w-12 text-center">{{ $item->quantity }}</span>
                                                <button
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                    class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 transition flex items-center justify-center">
                                                    <i class="fa-solid fa-plus text-sm"></i>
                                                </button>
                                            </div>

                                            {{-- Price --}}
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">Subtotal</p>
                                                <p class="text-xl font-black text-pop-primary">
                                                    Rp
                                                    {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Clear Cart Button --}}
                        <button wire:click="clearCart" wire:confirm="Apakah Anda yakin ingin mengosongkan keranjang?"
                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 py-3 rounded-xl font-semibold transition">
                            <i class="fa-solid fa-trash-can mr-2"></i>
                            Kosongkan Keranjang
                        </button>
                    </div>

                    {{-- Order Summary --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                            <h3 class="font-bold text-xl mb-6 text-gray-800">Ringkasan Belanja</h3>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal ({{ $cartItems->count() }} item)</span>
                                    <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Ongkos Kirim</span>
                                    <span class="font-semibold text-green-600">GRATIS</span>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-lg text-gray-800">Total</span>
                                        <span class="font-black text-2xl text-pop-primary">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('user.order') }}"
                                class="w-full bg-pop-primary hover:bg-red-500 text-white py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 mb-3 block text-center">
                                <i class="fa-solid fa-credit-card mr-2"></i>
                                Lanjut ke Pembayaran
                            </a>

                            <a href="{{ route('user.main') }}"
                                class="block text-center text-pop-primary hover:text-red-500 font-semibold transition">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Lanjut Belanja
                            </a>

                            {{-- Promo Info --}}
                            <div class="mt-6 bg-pop-light rounded-xl p-4">
                                <h4 class="font-bold text-sm text-gray-800 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-tag text-pop-primary"></i>
                                    Keuntungan Berbelanja
                                </h4>
                                <ul class="space-y-2 text-xs text-gray-600">
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                        <span>Gratis ongkir untuk semua pembelian</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                        <span>Produk terjamin original</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                        <span>Pengiriman cepat & aman</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty Cart --}}
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-red-50 mb-6">
                        <i class="fa-solid fa-cart-shopping text-6xl text-pop-primary"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Keranjang Belanja Kosong</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Belum ada produk di keranjang Anda. Yuk, mulai belanja dan temukan minuman favoritmu!
                    </p>
                    <a href="{{ route('user.main') }}"
                        class="inline-flex items-center gap-3 bg-pop-primary hover:bg-red-500 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1">
                        <i class="fa-solid fa-shopping-bag"></i>
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>

@push('scripts')
    <script>
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
        });
    </script>
@endpush
