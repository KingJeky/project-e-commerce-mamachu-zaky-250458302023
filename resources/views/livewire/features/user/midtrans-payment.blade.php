<div>
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-4 shadow-sm">
                    <i class="fa-solid fa-credit-card mr-2"></i> Pembayaran
                </span>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-4">
                    Bayar dengan <span class="text-pop-primary">Midtrans</span>
                </h1>
                <p class="text-gray-600 text-lg">Selesaikan pembayaran Anda dengan aman dan mudah</p>
            </div>
        </div>
    </section>

    {{-- Payment Content --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Order Summary --}}
                    <div class="lg:col-span-2 space-y-6">
                        @if ($order)
                            {{-- Order Details Card --}}
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                                <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                                    <i class="fa-solid fa-file-invoice text-pop-primary"></i>
                                    Detail Pesanan
                                </h3>

                                <div class="space-y-3">
                                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                        <span class="text-gray-600">Order ID</span>
                                        <span class="font-bold text-gray-800">#{{ $order->id }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                        <span class="text-gray-600">Status Pembayaran</span>
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold capitalize">
                                            {{ $order->payment_status }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2">
                                        <span class="text-gray-800 font-semibold text-lg">Total Pembayaran</span>
                                        <span class="font-black text-2xl text-pop-primary">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Items Card --}}
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                                <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                                    <i class="fa-solid fa-box text-pop-primary"></i>
                                    Produk yang Dibeli ({{ $order->items->count() }} item)
                                </h3>

                                <div class="space-y-3">
                                    @foreach ($order->items as $item)
                                        <div
                                            class="flex justify-between items-start pb-3 border-b border-gray-100 last:border-b-0 last:pb-0">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-800">{{ $item->product->name }}
                                                </h4>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ number_format($item->unit_amount, 0, ',', '.') }} x
                                                    {{ $item->quantity }}
                                                </p>
                                            </div>
                                            <span class="font-bold text-pop-primary">
                                                Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Shipping Address Card --}}
                            @if ($order->address)
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                                    <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                                        <i class="fa-solid fa-location-dot text-pop-primary"></i>
                                        Alamat Pengiriman
                                    </h3>

                                    <div class="bg-pop-light rounded-xl p-4">
                                        <div class="flex items-start gap-3">
                                            <i class="fa-solid fa-map-marker-alt text-pop-primary mt-1"></i>
                                            <div>
                                                <p class="font-bold text-gray-800">{{ $order->address->full_name }}
                                                </p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $order->address->phone }}</p>
                                                <p class="text-sm text-gray-700 mt-2">
                                                    {{ $order->address->full_address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            {{-- Order Not Found --}}
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-50 mb-4">
                                    <i class="fa-solid fa-exclamation-triangle text-4xl text-pop-primary"></i>
                                </div>
                                <h3 class="font-bold text-xl text-gray-800 mb-2">Order Tidak Ditemukan</h3>
                                <p class="text-gray-600 mb-6">Maaf, order yang Anda cari tidak dapat ditemukan.</p>
                                <a href="{{ route('user.my-orders') }}"
                                    class="inline-flex items-center gap-2 bg-pop-primary hover:bg-red-500 text-white px-6 py-3 rounded-full font-bold transition">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    Kembali ke Pesanan Saya
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Payment Action Sidebar --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                            @if ($order && $snapToken)
                                <div class="text-center mb-6">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 mb-4">
                                        <i class="fa-brands fa-cc-visa text-3xl text-white"></i>
                                    </div>
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Siap untuk Bayar?</h3>
                                    <p class="text-sm text-gray-600">Klik tombol di bawah untuk melanjutkan ke halaman
                                        pembayaran</p>
                                </div>

                                <button id="pay-button"
                                    class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white py-4 rounded-full font-bold text-lg shadow-lg shadow-purple-200 transition transform hover:-translate-y-1 mb-4">
                                    <i class="fa-solid fa-lock mr-2"></i>
                                    Bayar Sekarang
                                </button>

                                <a href="{{ route('user.my-orders') }}"
                                    class="block text-center text-pop-primary hover:text-red-500 font-semibold transition">
                                    <i class="fa-solid fa-arrow-left mr-2"></i>
                                    Kembali ke Pesanan Saya
                                </a>

                                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
                                </script>
                                <script type="text/javascript">
                                    document.getElementById('pay-button').onclick = function() {
                                        snap.pay('{{ $snapToken }}', {
                                            onSuccess: function(result) {
                                                console.log('success');
                                                console.log(result);
                                                // Add flag to force payment status check
                                                window.location.href =
                                                    '{{ route('user.my-orders') }}?check_payment={{ $order->id }}';
                                            },
                                            onPending: function(result) {
                                                console.log('pending');
                                                console.log(result);
                                                // Add flag to force payment status check
                                                window.location.href =
                                                    '{{ route('user.my-orders') }}?check_payment={{ $order->id }}';
                                            },
                                            onError: function(result) {
                                                console.log('error');
                                                console.log(result);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Pembayaran Gagal',
                                                    text: 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.',
                                                    confirmButtonColor: '#EF4444',
                                                });
                                            },
                                            onClose: function() {
                                                console.log('customer closed the popup without finishing the payment');
                                            }
                                        });
                                    };
                                </script>

                                {{-- Payment Methods Info --}}
                                <div class="mt-6 bg-purple-50 rounded-xl p-4">
                                    <h4 class="font-bold text-sm text-gray-800 mb-3">Metode Tersedia</h4>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-white rounded-lg p-2 text-center">
                                            <i class="fa-brands fa-cc-visa text-xl text-blue-600"></i>
                                            <p class="text-xs text-gray-600 mt-1">Credit Card</p>
                                        </div>
                                        <div class="bg-white rounded-lg p-2 text-center">
                                            <i class="fa-solid fa-wallet text-xl text-green-600"></i>
                                            <p class="text-xs text-gray-600 mt-1">GoPay</p>
                                        </div>
                                        <div class="bg-white rounded-lg p-2 text-center">
                                            <i class="fa-solid fa-qrcode text-xl text-purple-600"></i>
                                            <p class="text-xs text-gray-600 mt-1">QRIS</p>
                                        </div>
                                        <div class="bg-white rounded-lg p-2 text-center">
                                            <i class="fa-solid fa-building-columns text-xl text-indigo-600"></i>
                                            <p class="text-xs text-gray-600 mt-1">VA Bank</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Security Badge --}}
                                <div class="mt-6 bg-pop-light rounded-xl p-4">
                                    <h4 class="font-bold text-sm text-gray-800 mb-2 flex items-center gap-2">
                                        <i class="fa-solid fa-shield-halved text-pop-primary"></i>
                                        Pembayaran Aman
                                    </h4>
                                    <ul class="space-y-2 text-xs text-gray-600">
                                        <li class="flex items-start gap-2">
                                            <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                            <span>Dienkripsi dengan SSL</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                            <span>Terpercaya oleh Midtrans</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <i class="fa-solid fa-check-circle text-green-600 mt-0.5"></i>
                                            <span>Data pribadi terlindungi</span>
                                        </li>
                                    </ul>
                                </div>
                            @elseif($order && !$snapToken)
                                {{-- Token Failed --}}
                                <div class="text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-50 mb-4">
                                        <i class="fa-solid fa-exclamation-circle text-3xl text-pop-primary"></i>
                                    </div>
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Token Gagal</h3>
                                    <p class="text-sm text-gray-600 mb-4">Gagal memuat token pembayaran. Silakan coba
                                        lagi.</p>
                                    <a href="{{ route('user.my-orders') }}"
                                        class="inline-flex items-center gap-2 bg-pop-primary hover:bg-red-500 text-white px-6 py-3 rounded-full font-bold transition">
                                        <i class="fa-solid fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
