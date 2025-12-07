<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl transform transition-all">

            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-heading font-bold text-pop-dark">
                        {{ $brand_id ? '✏️ Edit Brand' : '➕ Tambah Brand Baru' }}
                    </h3>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>
                <p class="text-gray-500 text-sm mt-1">Lengkapi informasi brand produk Anda</p>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="store">
                <div class="p-6 space-y-5">

                    <!-- Brand Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                            Nama Brand <span class="text-pop-primary">*</span>
                        </label>
                        <input type="text" id="name" wire:model.lazy="name"
                            placeholder="Contoh: Coca Cola, Fanta, dll"
                            class="w-full px-4 py-3 rounded-xl border-2 @error('name') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Brand Image -->
                    <div>
                        <label for="newImage" class="block text-sm font-bold text-gray-700 mb-2">
                            Gambar Brand
                        </label>

                        <div class="relative">
                            <input type="file" id="newImage" wire:model="newImage" accept="image/*" class="hidden">

                            <label for="newImage"
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed @error('newImage') border-red-300 @else border-gray-300 @enderror rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-400 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500 font-semibold">
                                        <span class="text-pop-primary">Klik untuk upload</span> atau drag and drop
                                    </p>
                                    <p class="text-xs text-gray-400">PNG, JPG, atau JPEG (MAX. 2MB)</p>
                                </div>
                            </label>
                        </div>

                        <!-- Loading Indicator -->
                        <div wire:loading wire:target="newImage" class="mt-3 flex items-center gap-2 text-pop-primary">
                            <div
                                class="animate-spin rounded-full h-4 w-4 border-2 border-pop-primary border-t-transparent">
                            </div>
                            <span class="text-sm font-semibold">Mengupload...</span>
                        </div>

                        <!-- Image Preview -->
                        @if ($newImage)
                            <div class="mt-4 relative inline-block">
                                <img src="{{ $newImage->temporaryUrl() }}"
                                    class="w-32 h-32 object-cover rounded-2xl border-4 border-white shadow-lg">
                                <div
                                    class="absolute -top-2 -right-2 bg-green-500 text-white w-7 h-7 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                            </div>
                        @elseif ($image)
                            <div class="mt-4 relative inline-block">
                                <img src="{{ asset('storage/' . $image) }}"
                                    class="w-32 h-32 object-cover rounded-2xl border-4 border-white shadow-lg">
                                <div
                                    class="absolute -top-2 -right-2 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    Current
                                </div>
                            </div>
                        @endif

                        @error('newImage')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                        <input type="checkbox" id="is_active" wire:model="is_active"
                            class="w-5 h-5 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2 cursor-pointer">
                        <label for="is_active"
                            class="text-sm font-semibold text-gray-700 cursor-pointer select-none flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-green-500"></i>
                            Brand Aktif (Tampil di landing page)
                        </label>
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
                            class="animate-spin rounded-full h-4 w-4 border-2 border-white border-t-transparent"></div>
                        <i wire:loading.remove wire:target="store"
                            class="fa-solid {{ $brand_id ? 'fa-pen-to-square' : 'fa-floppy-disk' }}"></i>
                        <span>{{ $brand_id ? 'Update Brand' : 'Simpan Brand' }}</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
