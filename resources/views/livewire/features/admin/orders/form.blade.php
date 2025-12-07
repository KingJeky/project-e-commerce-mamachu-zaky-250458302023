@if ($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl transform transition-all">

                <!-- Modal Header -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-heading font-bold text-pop-dark">
                            {{ $is_edit_mode ? '✏️ Edit Order' : '➕ Tambah Order Baru' }}
                        </h3>
                        <button type="button" wire:click="closeModal"
                            class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                            <i class="fa-solid fa-xmark text-2xl"></i>
                        </button>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi informasi pesanan</p>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="store">
                    <div class="p-6 space-y-5">

                        <!-- Customer -->
                        <div>
                            <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">
                                Customer <span class="text-pop-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <select id="user_id" wire:model="user_id"
                                    class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('user_id') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all appearance-none bg-white cursor-pointer">
                                    <option value="">Pilih Customer</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </div>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Grand Total -->
                        <div>
                            <label for="grand_total" class="block text-sm font-bold text-gray-700 mb-2">
                                Grand Total <span class="text-pop-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                <input type="number" id="grand_total" wire:model="grand_total" placeholder="100000"
                                    class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('grand_total') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                            </div>
                            @error('grand_total')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Order Status -->
                        <div>
                            <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
                                Order Status <span class="text-pop-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-box"></i>
                                </span>
                                <select id="status" wire:model="status"
                                    class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('status') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all appearance-none bg-white cursor-pointer">
                                    <option value="">Pilih Status</option>
                                    <option value="new">🆕 New</option>
                                    <option value="processing">⚙️ Processing</option>
                                    <option value="shipped">🚚 Shipped</option>
                                    <option value="delivered">✅ Delivered</option>
                                    <option value="cancelled">❌ Cancelled</option>
                                </select>
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="block text-sm font-bold text-gray-700 mb-2">
                                Payment Status <span class="text-pop-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-credit-card"></i>
                                </span>
                                <select id="payment_status" wire:model="payment_status"
                                    class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('payment_status') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all appearance-none bg-white cursor-pointer">
                                    <option value="">Pilih Payment Status</option>
                                    <option value="pending">🕐 Pending</option>
                                    <option value="paid">✅ Paid</option>
                                    <option value="failed">❌ Failed</option>
                                </select>
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </div>
                            @error('payment_status')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="p-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 sm:justify-end">
                        <button type="button" wire:click="closeModal"
                            class="px-6 py-3 rounded-full border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-xmark"></i>
                            <span>Batal</span>
                        </button>

                        <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-3 rounded-full bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white font-bold shadow-lg shadow-red-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <div wire:loading wire:target="store"
                                class="animate-spin rounded-full h-4 w-4 border-2 border-white border-t-transparent">
                            </div>
                            <i wire:loading.remove wire:target="store"
                                class="fa-solid {{ $is_edit_mode ? 'fa-pen-to-square' : 'fa-floppy-disk' }}"></i>
                            <span>{{ $is_edit_mode ? 'Update Order' : 'Simpan Order' }}</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endif
