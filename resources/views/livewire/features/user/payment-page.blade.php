<div>
    {{-- Header --}}
    <section class="pt-32 pb-8 bg-gradient-to-br from-pop-light to-white">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <span
                    class="bg-pop-secondary text-pop-dark px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase inline-block mb-4 shadow-sm">
                    <i class="fa-solid fa-money-bill-transfer mr-2"></i> Pembayaran
                </span>
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-4">
                    Transfer Bank <span class="text-pop-primary">Manual</span>
                </h1>
                <p class="text-gray-600 text-lg">Silakan transfer ke rekening berikut dan upload bukti bayar</p>
            </div>
        </div>
    </section>

    {{-- Payment Content --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                {{-- Bank Info Card --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Rekening Bank</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl">
                            <i class="fa-solid fa-building-columns text-blue-600 text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-1">Bank:</p>
                                <p class="text-xl font-bold text-gray-800">BCA</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-green-50 rounded-xl">
                            <i class="fa-solid fa-credit-card text-green-600 text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-1">No. Rekening:</p>
                                <p class="text-xl font-black text-gray-800 tracking-wide">123-456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-purple-50 rounded-xl">
                            <i class="fa-solid fa-user text-purple-600 text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-1">Atas Nama:</p>
                                <p class="text-xl font-bold text-gray-800">Batik Urang Store</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-red-50 rounded-xl border-2 border-pop-primary">
                            <i class="fa-solid fa-money-bill-wave text-pop-primary text-2xl mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 mb-1">Total Transfer:</p>
                                <p class="text-3xl font-black text-pop-primary">
                                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-info text-yellow-600 text-xl flex-shrink-0 mt-0.5"></i>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold mb-1">Penting:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Transfer sesuai nominal yang tertera</li>
                                    <li>Upload bukti transfer untuk verifikasi</li>
                                    <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upload Form --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up text-pop-primary"></i>
                        Upload Bukti Bayar
                    </h2>

                    <form wire:submit.prevent="submitPayment">
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3">
                                Pilih file bukti bayar: <span class="text-red-500">*</span>
                            </label>

                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-pop-primary transition">
                                <input type="file" wire:model="paymentProof" accept="image/*" class="hidden"
                                    id="paymentProofInput">

                                <label for="paymentProofInput" class="cursor-pointer">
                                    <div class="mb-4">
                                        @if ($paymentProof)
                                            <div class="inline-block relative">
                                                <img src="{{ $paymentProof->temporaryUrl() }}"
                                                    class="max-h-64 rounded-lg shadow-md">
                                                <button type="button" wire:click="$set('paymentProof', null)"
                                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition">
                                                    <i class="fa-solid fa-times"></i>
                                                </button>
                                            </div>
                                        @else
                                            <i class="fa-solid fa-image text-6xl text-gray-400 mb-3"></i>
                                            <p class="text-gray-600 font-medium">Klik untuk upload bukti transfer</p>
                                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, JPEG (Max: 2MB)</p>
                                        @endif
                                    </div>
                                </label>

                                @error('paymentProof')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div wire:loading wire:target="paymentProof" class="mt-3">
                                <div class="flex items-center justify-center gap-2 text-pop-primary">
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                    <span class="font-medium">Mengupload file...</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="{{ route('user.my-orders') }}"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-4 rounded-full font-bold text-lg text-center transition">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Batal
                            </a>

                            <button type="submit"
                                class="flex-1 bg-pop-primary hover:bg-red-500 text-white py-4 rounded-full font-bold text-lg shadow-lg shadow-red-200 transition transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                wire:loading.attr="disabled" wire:target="submitPayment"
                                @if (!$paymentProof) disabled @endif>
                                <span wire:loading.remove wire:target="submitPayment">
                                    <i class="fa-solid fa-check-circle mr-2"></i>
                                    Simpan
                                </span>
                                <span wire:loading wire:target="submitPayment">
                                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                                    Menyimpan...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Order Details Summary --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Detail Pesanan #{{ $order->id }}</h3>
                    <div class="space-y-2 text-sm">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between text-gray-600">
                                <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                                <span class="font-semibold">Rp
                                    {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="border-t pt-2 mt-2 flex justify-between font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-pop-primary">Rp
                                {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
