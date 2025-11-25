<div>
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-4 shadow-sm">
                    <i class="fa-solid fa-credit-card mr-2"></i> Checkout
                </span>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-4">
                    Konfirmasi <span class="text-pop-primary">Pesanan</span>
                </h1>
                <p class="text-gray-600 text-lg">Periksa kembali pesanan Anda sebelum checkout</p>
            </div>
        </div>
    </section>

    {{-- Checkout Content --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Form --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Shipping Address Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-pop-primary"></i>
                            Alamat Pengiriman
                        </h3>

                        @if ($addresses->count() > 0)
                            <div class="space-y-3">
                                @foreach ($addresses as $address)
                                    <label
                                        class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition
                                        {{ $selectedAddressId == $address->id ? 'border-pop-primary bg-red-50' : 'border-gray-200 hover:border-gray-300' }}">
                                        <input type="radio" wire:model.live="selectedAddressId"
                                            value="{{ $address->id }}"
                                            class="mt-1 text-pop-primary focus:ring-pop-primary">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-bold text-gray-800">{{ $address->label }}</span>
                                                @if ($address->is_default)
                                                    <span
                                                        class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full font-semibold">Default</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-700 font-medium">{{ $address->full_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $address->full_address }}</p>
                                        </div>
                                    </label>
                                @endforeach
                                @error('selectedAddressId')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <a href="{{ route('user.addresses') }}" target="_blank"
                                class="inline-flex items-center gap-2 text-pop-primary hover:text-red-500 font-semibold mt-4 transition">
                                <i class="fa-solid fa-plus"></i>
                                Tambah Alamat Baru
                            </a>
                        @else
                            <div class="text-center py-8">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 mb-4">
                                    <i class="fa-solid fa-map-marker-alt text-3xl text-pop-primary"></i>
                                </div>
                                <h4 class="font-bold text-lg text-gray-800 mb-2">Belum Ada Alamat</h4>
                                <p class="text-gray-600 mb-4">Silakan tambahkan alamat pengiriman terlebih dahulu</p>
                                <a href="{{ route('user.addresses') }}"
                                    class="inline-flex items-center gap-2 bg-pop-primary hover:bg-red-500 text-white px-6 py-3 rounded-full font-bold transition">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Alamat
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Order Items Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-box text-pop-primary"></i>
                            Produk yang Dibeli ({{ $cartItems->count() }} item)
                        </h3>

                        <div class="space-y-4">
                            @foreach ($cartItems as $item)
                                <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                                    {{-- Product Image --}}
                                    <div class="flex-shrink-0">
                                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100">
                                            @if (!empty($item->product->images))
                                                <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fa-solid fa-image text-gray-400 text-xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Product Info --}}
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800 mb-1">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->product->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-sm text-gray-600">Jumlah: <span
                                                    class="font-bold">{{ $item->quantity }}</span></span>
                                            <span class="font-bold text-pop-primary">
                                                Rp
                                                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Payment Method Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-wallet text-pop-primary"></i>
                            Metode Pembayaran
                        </h3>

                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-4 p-4 rounded-xl border-2 border-pop-primary bg-red-50 cursor-pointer">
                                <input type="radio" wire:model.live="paymentMethod" value="transfer" checked
                                    class="text-pop-primary focus:ring-pop-primary">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-building-columns text-blue-600"></i>
                                        <span class="font-bold text-gray-800">Transfer Bank</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Transfer ke rekening bank</p>
                                </div>
                            </label>
                            @error('paymentMethod')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Notes Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-note-sticky text-pop-primary"></i>
                            Catatan Pesanan (Opsional)
                        </h3>
                        <textarea wire:model="notes" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pop-primary focus:border-transparent resize-none"
                            placeholder="Tambahkan catatan untuk pesanan Anda..."></textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Order Summary Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h3 class="font-bold text-xl mb-6 text-gray-800">Ringkasan Pesanan</h3>

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
                                    <span class="font-bold text-lg text-gray-800">Total Pembayaran</span>
                                    <span class="font-black text-2xl text-pop-primary">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if ($addresses->count() > 0)
                            <button wire:click="placeOrder"
                                class="w-full bg-pop-primary hover:bg-red-500 text-white py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 mb-3">
                                <i class="fa-solid fa-check-circle mr-2"></i>
                                Buat Pesanan
                            </button>
                        @else
                            <div
                                class="w-full bg-gray-300 text-gray-600 py-4 rounded-full font-bold text-lg text-center mb-3 cursor-not-allowed">
                                <i class="fa-solid fa-exclamation-circle mr-2"></i>
                                Tambah Alamat Dulu
                            </div>
                        @endif

                        <a href="{{ route('user.cart') }}"
                            class="block text-center text-pop-primary hover:text-red-500 font-semibold transition">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            Kembali ke Keranjang
                        </a>

                        {{-- Security Info --}}
                        <div class="mt-6 bg-pop-light rounded-xl p-4">
                            <h4 class="font-bold text-sm text-gray-800 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-pop-primary"></i>
                                Transaksi Aman
                            </h4>
                            <ul class="space-y-2 text-xs text-gray-600">
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                    <span>Data Anda dilindungi dengan enkripsi</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                    <span>Produk terjamin original</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                    <span>Gratis ongkir untuk semua pembelian</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:error', (event) => {
                const {
                    title,
                    text
                } = event;
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: text,
                    confirmButtonColor: '#EF4444',
                });
            });
        });
    </script>
@endpush
