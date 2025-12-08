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
                                        @if ($order->payment_status == 'pending')
                                            {{-- PENDING PAYMENT: Show Pay & Cancel Buttons --}}

                                            @if ($order->payment_method == 'midtrans')
                                                {{-- Midtrans Payment --}}
                                                <a href="{{ route('user.midtrans-payment', ['orderId' => $order->id]) }}"
                                                    class="flex-1 bg-pop-primary hover:bg-red-500 text-white py-3 rounded-full font-bold text-center shadow-lg shadow-red-200 transition transform hover:-translate-y-1">
                                                    <i class="fa-solid fa-credit-card mr-2"></i>
                                                    Bayar Sekarang
                                                </a>

                                                {{-- Manual Confirm for Testing (Sandbox) --}}
                                                <button wire:click="manualConfirmPayment('{{ $order->id }}')"
                                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-full font-bold shadow-lg shadow-green-200 transition transform hover:-translate-y-1">
                                                    <i class="fa-solid fa-check-circle mr-2"></i>
                                                    Konfirmasi Manual
                                                </button>
                                            @else
                                                {{-- Transfer Bank Payment --}}
                                                <a href="{{ route('user.payment', ['orderId' => $order->id]) }}"
                                                    class="flex-1 bg-pop-primary hover:bg-red-500 text-white py-3 rounded-full font-bold text-center shadow-lg shadow-red-200 transition transform hover:-translate-y-1">
                                                    <i class="fa-solid fa-money-bill-transfer mr-2"></i>
                                                    Upload Bukti Bayar
                                                </a>
                                            @endif

                                            {{-- Cancel Order Button (always show for pending payment) --}}
                                            <button onclick="confirmCancelOrder('{{ $order->id }}')"
                                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-full font-bold transition">
                                                <i class="fa-solid fa-times-circle mr-2"></i>
                                                Batalkan Pesanan
                                            </button>
                                        @elseif ($order->payment_status == 'paid')
                                            {{-- PAID: Show Confirm Receipt Button or Completed Status --}}

                                            @if ($order->receipt_proof)
                                                {{-- Already confirmed --}}
                                                <div
                                                    class="flex-1 bg-green-50 border-2 border-green-500 text-green-700 py-3 px-6 rounded-full font-bold text-center">
                                                    <i class="fa-solid fa-check-double mr-2"></i>
                                                    Pesanan Sudah Dikonfirmasi
                                                </div>
                                            @else
                                                {{-- Show confirm button based on order status --}}
                                                @if ($order->status == 'delivered')
                                                    {{-- Delivered: User can confirm receipt --}}
                                                    <button wire:click="confirmDelivery('{{ $order->id }}')"
                                                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-full font-bold shadow-lg shadow-green-200 transition transform hover:-translate-y-1">
                                                        <i class="fa-solid fa-box-check mr-2"></i>
                                                        Konfirmasi Penerimaan Barang
                                                    </button>
                                                @else
                                                    {{-- Processing/Shipped: Show status info --}}
                                                    <div
                                                        class="flex-1 bg-blue-50 border-2 border-blue-500 text-blue-700 py-3 px-6 rounded-full font-bold text-center">
                                                        <i class="fa-solid fa-truck mr-2"></i>
                                                        {{ $this->getStatusLabel($order->status) }}
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            {{-- FAILED/CANCELLED: Show status only --}}
                                            <div
                                                class="flex-1 bg-red-50 border-2 border-red-500 text-red-700 py-3 px-6 rounded-full font-bold text-center">
                                                <i class="fa-solid fa-exclamation-circle mr-2"></i>
                                                {{ $this->getPaymentStatusLabel($order->payment_status) }}
                                            </div>
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

    {{-- Receipt Proof Upload Modal --}}
    @if ($confirmingOrderId)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: true }">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background overlay --}}
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                    wire:click="cancelConfirmDelivery"></div>

                {{-- Modal panel --}}
                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    {{-- Modal Header --}}
                    <div class="bg-gradient-to-r from-green-600 to-green-500 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                <i class="fa-solid fa-camera"></i>
                                Konfirmasi Penerimaan Pesanan
                            </h3>
                            <button wire:click="cancelConfirmDelivery"
                                class="text-white hover:text-gray-200 transition">
                                <i class="fa-solid fa-times text-2xl"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Modal Body --}}
                    <div class="px-6 py-6">
                        <p class="text-gray-700 mb-4">
                            <i class="fa-solid fa-info-circle text-blue-500 mr-2"></i>
                            Silakan upload foto bukti bahwa Anda telah menerima pesanan ini.
                        </p>

                        {{-- File Input --}}
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Foto Bukti Penerimaan <span class="text-red-500">*</span>
                            </label>
                            <input type="file" wire:model="receiptProof" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                            @error('receiptProof')
                                <p class="mt-2 text-sm text-red-600">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Image Preview --}}
                        @if ($receiptProof)
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Preview:</label>
                                <div class="relative rounded-xl overflow-hidden border-2 border-gray-200">
                                    <img src="{{ $receiptProof->temporaryUrl() }}" alt="Preview"
                                        class="w-full h-64 object-cover">
                                </div>
                            </div>
                        @endif

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-sm text-yellow-800">
                            <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                            Pastikan foto jelas dan dapat terbaca. Maksimal ukuran file 2MB.
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end">
                        <button wire:click="cancelConfirmDelivery"
                            class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-full transition">
                            <i class="fa-solid fa-times mr-2"></i>
                            Batal
                        </button>
                        <button wire:click="uploadReceiptProof" wire:loading.attr="disabled"
                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full shadow-lg transition disabled:opacity-50">
                            <span wire:loading.remove wire:target="uploadReceiptProof">
                                <i class="fa-solid fa-check mr-2"></i>
                                Konfirmasi & Upload
                            </span>
                            <span wire:loading wire:target="uploadReceiptProof">
                                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                Mengunggah...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
