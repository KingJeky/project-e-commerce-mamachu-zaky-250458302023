<div>
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-2">
                    Order <span class="text-pop-primary">Management</span>
                </h1>
                <p class="text-gray-600 text-lg">Kelola pesanan pelanggan</p>
            </div>

            <!-- Main Card -->
            <div
                class="bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden">

                <!-- Card Header -->
                <div class="p-6 md:p-8 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Daftar Pesanan</h2>
                            <p class="text-gray-500 text-sm">Kelola semua pesanan pelanggan</p>
                        </div>
                        <button wire:click="create"
                            class="bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2 w-full sm:w-auto justify-center">
                            <i class="fa-solid fa-plus-circle"></i>
                            <span>Tambah Order</span>
                        </button>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-8">

                    <!-- Search Box -->
                    <div class="mb-6">
                        <div class="relative">
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="w-full px-5 py-3 pl-12 rounded-full border-2 border-gray-200 focus:border-pop-primary focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all"
                                placeholder="Cari pesanan berdasarkan nama customer atau Order ID...">
                            <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-2xl border border-gray-100">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Order ID
                                    </th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Customer
                                    </th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Order Date
                                    </th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Total</th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Order
                                        Status
                                    </th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Payment
                                        Status
                                    </th>
                                    <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $order)
                                    <tr
                                        class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-red-50/50 transition-all duration-200">
                                        <td class="py-4 px-4">
                                            <span class="font-bold text-pop-primary">#{{ $order->id }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="font-semibold text-gray-700">{{ $order->user->name }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="text-gray-600 text-sm">{{ $order->created_at->format('d F Y') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="font-bold text-green-600">Rp
                                                {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            @php
                                                $statusConfig = [
                                                    'new' => ['color' => 'blue', 'label' => 'New'],
                                                    'processing' => ['color' => 'purple', 'label' => 'Processing'],
                                                    'shipped' => ['color' => 'yellow', 'label' => 'Shipped'],
                                                    'delivered' => ['color' => 'green', 'label' => 'Delivered'],
                                                    'completed' => ['color' => 'green', 'label' => 'Completed'],
                                                    'cancelled' => ['color' => 'red', 'label' => 'Cancelled'],
                                                ];
                                                $status =
                                                    $statusConfig[strtolower($order->status ?? 'new')] ??
                                                    $statusConfig['new'];
                                            @endphp
                                            <span
                                                class="bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-600 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $status['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            @php
                                                $paymentConfig = [
                                                    'pending' => ['color' => 'yellow', 'label' => 'Pending'],
                                                    'paid' => ['color' => 'green', 'label' => 'Paid'],
                                                    'failed' => ['color' => 'red', 'label' => 'Failed'],
                                                    'refunded' => ['color' => 'blue', 'label' => 'Refunded'],
                                                ];
                                                $payment =
                                                    $paymentConfig[strtolower($order->payment_status ?? 'pending')] ??
                                                    $paymentConfig['pending'];
                                            @endphp
                                            <span
                                                class="bg-{{ $payment['color'] }}-100 text-{{ $payment['color'] }}-600 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $payment['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex gap-2">
                                                <button wire:click="viewOrderProofs('{{ $order->id }}')"
                                                    class="bg-purple-500 hover:bg-purple-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                    title="View Proofs">
                                                    <i class="fa-solid fa-image"></i>
                                                </button>
                                                <button wire:click="edit('{{ $order->id }}')"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button x-data
                                                    @click.prevent="
                                                Swal.fire({
                                                    title: 'Yakin hapus pesanan?',
                                                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#FF6B6B',
                                                    cancelButtonColor: '#6B7280',
                                                    confirmButtonText: 'Ya, hapus!',
                                                    cancelButtonText: 'Batal',
                                                    iconColor: '#FF6B6B',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        @this.call('delete', '{{ $order->id }}');
                                                    }
                                                });
                                            "
                                                    class="bg-red-500 hover:bg-red-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class="fa-solid fa-receipt text-gray-300 text-5xl mb-4"></i>
                                                <p class="text-gray-500 font-semibold">Belum ada pesanan</p>
                                                <p class="text-gray-400 text-sm mt-1">Pesanan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center sm:justify-end">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Proof Viewing Modal --}}
    @if ($showProofModal && $viewingOrder)
        <div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.7);">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div
                    class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl transform transition-all max-h-[90vh] overflow-y-auto">

                    <!-- Modal Header -->
                    <div class="p-6 border-b border-gray-100 sticky top-0 bg-white rounded-t-3xl z-10">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl font-heading font-bold text-pop-dark">
                                📸 Order Proofs - <span class="text-pop-primary">#{{ $viewingOrder->id }}</span>
                            </h3>
                            <button type="button" wire:click="closeProofModal"
                                class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                                <i class="fa-solid fa-xmark text-2xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-5">

                        <!-- Order Information Card -->
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6">
                            <h4 class="font-heading font-bold text-lg text-pop-dark mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-circle-info"></i>
                                Informasi Pesanan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[120px]">Customer:</span>
                                        <span class="text-gray-800">{{ $viewingOrder->user->name }}</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[120px]">Order Date:</span>
                                        <span
                                            class="text-gray-800">{{ $viewingOrder->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[120px]">Payment Method:</span>
                                        <span class="text-gray-800">{{ ucfirst($viewingOrder->payment_method) }}</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[100px]">Status:</span>
                                        @php
                                            $statusConfig = [
                                                'new' => ['color' => 'blue', 'label' => 'New'],
                                                'processing' => ['color' => 'purple', 'label' => 'Processing'],
                                                'shipped' => ['color' => 'yellow', 'label' => 'Shipped'],
                                                'delivered' => ['color' => 'green', 'label' => 'Delivered'],
                                                'completed' => ['color' => 'green', 'label' => 'Completed'],
                                                'cancelled' => ['color' => 'red', 'label' => 'Cancelled'],
                                            ];
                                            $status =
                                                $statusConfig[strtolower($viewingOrder->status ?? 'new')] ??
                                                $statusConfig['new'];
                                        @endphp
                                        <span
                                            class="bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-600 px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $status['label'] }}
                                        </span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[100px]">Payment:</span>
                                        @php
                                            $paymentConfig = [
                                                'pending' => ['color' => 'yellow', 'label' => 'Pending'],
                                                'paid' => ['color' => 'green', 'label' => 'Paid'],
                                                'failed' => ['color' => 'red', 'label' => 'Failed'],
                                            ];
                                            $payment =
                                                $paymentConfig[
                                                    strtolower($viewingOrder->payment_status ?? 'pending')
                                                ] ?? $paymentConfig['pending'];
                                        @endphp
                                        <span
                                            class="bg-{{ $payment['color'] }}-100 text-{{ $payment['color'] }}-600 px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $payment['label'] }}
                                        </span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-gray-600 font-semibold min-w-[100px]">Total:</span>
                                        <span class="text-green-600 font-bold text-lg">Rp
                                            {{ number_format($viewingOrder->grand_total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Proof (for transfer method) -->
                        @if ($viewingOrder->payment_method == 'transfer')
                            <div class="bg-white rounded-2xl border-2 border-gray-100 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                                    <h5 class="font-bold text-white flex items-center gap-2">
                                        <i class="fa-solid fa-receipt"></i>
                                        Bukti Pembayaran
                                    </h5>
                                </div>
                                <div class="p-6">
                                    @if ($viewingOrder->payment_proof)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $viewingOrder->payment_proof) }}"
                                                alt="Payment Proof"
                                                class="max-w-full max-h-96 mx-auto rounded-2xl shadow-lg border-4 border-white">
                                            <p
                                                class="mt-4 text-green-600 font-semibold flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-check-circle"></i>
                                                Bukti pembayaran sudah diupload
                                            </p>
                                        </div>
                                    @else
                                        <div
                                            class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 text-center">
                                            <i
                                                class="fa-solid fa-exclamation-triangle text-yellow-500 text-3xl mb-2"></i>
                                            <p class="text-yellow-700 font-semibold">Belum ada bukti pembayaran</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                                <p class="text-blue-700 font-semibold flex items-center gap-2">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Metode pembayaran {{ ucfirst($viewingOrder->payment_method) }} - Tidak perlu bukti
                                    transfer
                                </p>
                            </div>
                        @endif

                        <!-- Receipt Proof -->
                        <div class="bg-white rounded-2xl border-2 border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                                <h5 class="font-bold text-white flex items-center gap-2">
                                    <i class="fa-solid fa-box-open"></i>
                                    Bukti Penerimaan
                                </h5>
                            </div>
                            <div class="p-6">
                                @if ($viewingOrder->receipt_proof)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $viewingOrder->receipt_proof) }}"
                                            alt="Receipt Proof"
                                            class="max-w-full max-h-96 mx-auto rounded-2xl shadow-lg border-4 border-white">
                                        <p
                                            class="mt-4 text-green-600 font-semibold flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Customer sudah konfirmasi penerimaan
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 text-center">
                                        <i class="fa-solid fa-exclamation-triangle text-yellow-500 text-3xl mb-2"></i>
                                        <p class="text-yellow-700 font-semibold">
                                            @if ($viewingOrder->status == 'delivered')
                                                Menunggu customer konfirmasi penerimaan
                                            @else
                                                Pesanan belum dikirim
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="p-6 border-t border-gray-100 sticky bottom-0 bg-white rounded-b-3xl">
                        <button wire:click="closeProofModal"
                            class="w-full sm:w-auto px-6 py-3 rounded-full bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white font-bold shadow-lg transition-all mx-auto block">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('livewire.features.admin.orders.form')

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('delete-prompt', ({
                    id
                }) => {
                    Swal.fire({
                        title: 'Yakin hapus pesanan?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#FF6B6B',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        iconColor: '#FF6B6B',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('delete', id);
                        }
                    })
                });
            });
        </script>
    @endpush

</div>
