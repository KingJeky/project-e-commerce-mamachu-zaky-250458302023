<div>
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-4 shadow-sm">
                    <i class="fa-solid fa-box mr-2"></i> Pesanan Saya
                </span>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-4">
                    Riwayat <span class="text-pop-primary">Pesanan</span>
                </h1>
                <p class="text-gray-600 text-lg">Lihat semua pesanan yang pernah Anda buat</p>
            </div>
        </div>
    </section>

    {{-- Orders Content --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            @if ($orders->count() > 0)
                <div class="space-y-6 max-w-5xl mx-auto">
                    @foreach ($orders as $order)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            {{-- Order Header --}}
                            <div class="bg-gradient-to-r from-pop-light to-white p-6 border-b border-gray-100">
                                <div class="flex flex-wrap justify-between items-start gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                                            <i class="fa-solid fa-hashtag text-pop-primary"></i>
                                            Order {{ $order->id }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            <i class="fa-solid fa-calendar mr-1"></i>
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="{{ $this->getStatusColor($order->status) }} px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $this->getStatusLabel($order->status) }}
                                        </span>
                                        <span
                                            class="{{ $this->getPaymentStatusColor($order->payment_status) }} px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $this->getPaymentStatusLabel($order->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Order Body --}}
                            <div class="p-6">
                                {{-- Order Items --}}
                                <div class="mb-6">
                                    <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                        <i class="fa-solid fa-box-open text-pop-primary"></i>
                                        Produk Pesanan ({{ $order->items->count() }} item)
                                    </h4>
                                    <div class="space-y-3">
                                        @foreach ($order->items as $item)
                                            <div class="flex gap-4 p-3 bg-gray-50 rounded-xl">
                                                {{-- Product Image --}}
                                                <div class="flex-shrink-0">
                                                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-white">
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
                                                <div class="flex-1 min-w-0">
                                                    <h5 class="font-bold text-gray-800 truncate">
                                                        {{ $item->product->name }}
                                                    </h5>
                                                    <p class="text-sm text-gray-600">
                                                        {{ $item->quantity }} x Rp
                                                        {{ number_format($item->unit_amount, 0, ',', '.') }}
                                                    </p>
                                                </div>

                                                {{-- Item Total --}}
                                                <div class="text-right">
                                                    <p class="font-bold text-pop-primary">
                                                        Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Order Details Grid --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    {{-- Shipping Info --}}
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <h5 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                            <i class="fa-solid fa-location-dot text-pop-primary"></i>
                                            Alamat Pengiriman
                                        </h5>
                                        @if ($order->address)
                                            <p class="text-sm text-gray-700 font-semibold">
                                                {{ $order->address->full_name }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{ $order->address->phone }}</p>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $order->address->full_address }}
                                            </p>
                                        @else
                                            <p class="text-sm text-gray-500 italic">Alamat tidak tersedia</p>
                                        @endif
                                    </div>

                                    {{-- Payment Info --}}
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <h5 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                                            <i class="fa-solid fa-wallet text-pop-primary"></i>
                                            Informasi Pembayaran
                                        </h5>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Metode:</span>
                                                <span
                                                    class="font-semibold text-gray-800">{{ $this->getPaymentMethodLabel($order->payment_method) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Ongkir:</span>
                                                <span class="font-semibold text-green-600">GRATIS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes (if exists) --}}
                                @if ($order->notes)
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                                        <h5 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                                            <i class="fa-solid fa-note-sticky text-yellow-600"></i>
                                            Catatan Pesanan
                                        </h5>
                                        <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                                    </div>
                                @endif

                                {{-- Order Total --}}
                                <div class="border-t border-gray-200 pt-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                                        <span class="text-2xl font-black text-pop-primary">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="flex flex-wrap gap-3">
                                        {{-- Pay Now Button for Pending Payment --}}
                                        @if ($order->payment_status == 'pending')
                                            @if ($order->payment_method == 'midtrans')
                                                {{-- Midtrans Payment --}}
                                                <a href="{{ route('user.midtrans-payment', ['orderId' => $order->id]) }}"
                                                    class="flex-1 bg-pop-primary hover:bg-red-500 text-white py-3 rounded-full font-bold text-center shadow-lg shadow-red-200 transition transform hover:-translate-y-1">
                                                    <i class="fa-solid fa-credit-card mr-2"></i>
                                                    Bayar dengan Midtrans
                                                </a>

                                                {{-- Check Status Button --}}
                                                <button wire:click="checkPaymentStatus({{ $order->id }})"
                                                    class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-full font-bold transition">
                                                    <i class="fa-solid fa-sync mr-2"></i>
                                                    Cek Status
                                                </button>
                                            @else
                                                {{-- Transfer Bank Payment --}}
                                                <a href="{{ route('user.payment', ['orderId' => $order->id]) }}"
                                                    class="flex-1 bg-pop-primary hover:bg-red-500 text-white py-3 rounded-full font-bold text-center shadow-lg shadow-red-200 transition transform hover:-translate-y-1">
                                                    <i class="fa-solid fa-money-bill-transfer mr-2"></i>
                                                    Upload Bukti Bayar
                                                </a>
                                            @endif
                                        @endif

                                        {{-- Cancel Order Button (only for new orders with pending payment) --}}
                                        @if ($order->status == 'new' && $order->payment_status == 'pending')
                                            <button onclick="confirmCancelOrder({{ $order->id }})"
                                                class="flex-1 bg-red-100 hover:bg-red-200 text-red-700 py-3 rounded-full font-bold transition">
                                                <i class="fa-solid fa-times-circle mr-2"></i>
                                                Batalkan Pesanan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-20 max-w-md mx-auto">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-red-50 mb-6">
                        <i class="fa-solid fa-box-open text-6xl text-pop-primary"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Pesanan</h3>
                    <p class="text-gray-600 mb-8">
                        Anda belum pernah melakukan pemesanan. Yuk, mulai belanja dan temukan minuman favoritmu!
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
        // Cancel Order Confirmation Function
        function confirmCancelOrder(orderId) {
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: 'Apakah Anda yakin ingin membatalkan pesanan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF6B6B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                customClass: {
                    popup: 'font-body',
                    title: 'font-heading',
                    confirmButton: 'font-semibold',
                    cancelButton: 'font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call Livewire method to cancel order
                    @this.call('cancelOrder', orderId);
                }
            });
        }

        // Listen to Livewire events for SweetAlert
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
                    customClass: {
                        popup: 'font-body',
                        title: 'font-heading'
                    }
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
                    confirmButtonColor: '#FF6B6B',
                    customClass: {
                        popup: 'font-body',
                        title: 'font-heading',
                        confirmButton: 'font-semibold'
                    }
                });
            });

            Livewire.on('swal:info', (event) => {
                const {
                    title,
                    text
                } = event;
                Swal.fire({
                    icon: 'info',
                    title: title,
                    text: text,
                    confirmButtonColor: '#6366f1',
                    customClass: {
                        popup: 'font-body',
                        title: 'font-heading',
                        confirmButton: 'font-semibold'
                    }
                });
            });
        });
    </script>
@endpush
