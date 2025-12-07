<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl transform transition-all max-h-[90vh] overflow-y-auto">

            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-100 sticky top-0 bg-white rounded-t-3xl z-10">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-heading font-bold text-pop-dark">
                        {{ $product_id ? '✏️ Edit Produk' : '➕ Tambah Produk Baru' }}
                    </h3>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>
                <p class="text-gray-500 text-sm mt-1">Lengkapi informasi produk minuman Anda</p>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="store">
                <div class="p-6 space-y-5">

                    <!-- Name & Price Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                Nama Produk <span class="text-pop-primary">*</span>
                            </label>
                            <input type="text" id="name" wire:model.lazy="name"
                                placeholder="Contoh: Coca Cola 330ml"
                                class="w-full px-4 py-3 rounded-xl border-2 @error('name') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-bold text-gray-700 mb-2">
                                Harga <span class="text-pop-primary">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                <input type="number" id="price" wire:model.lazy="price" placeholder="10000"
                                    class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('price') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                            </div>
                            @error('price')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Category & Brand Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">
                                Kategori <span class="text-pop-primary">*</span>
                            </label>
                            <select id="category_id" wire:model="category_id"
                                class="w-full px-4 py-3 rounded-xl border-2 @error('category_id') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="brand_id" class="block text-sm font-bold text-gray-700 mb-2">
                                Brand <span class="text-pop-primary">*</span>
                            </label>
                            <select id="brand_id" wire:model="brand_id"
                                class="w-full px-4 py-3 rounded-xl border-2 @error('brand_id') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                                <option value="">Pilih Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="description" wire:model.lazy="description" rows="3" placeholder="Deskripsikan produk Anda..."
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-pop-primary focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all resize-none"></textarea>
                    </div>

                    <!-- Images Upload -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            Gambar Produk <span class="text-gray-500 font-normal">(Maksimal 3 gambar)</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ([1, 2, 3] as $i)
                                @php
                                    $newImage = 'newImage' . $i;
                                    $existingImage = $images[$i - 1] ?? null;
                                @endphp
                                <div class="relative">
                                    <input type="file" id="newImage{{ $i }}"
                                        wire:model="newImage{{ $i }}" accept="image/*" class="hidden">

                                    <label for="newImage{{ $i }}"
                                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed @error('newImage' . $i) border-red-300 @else border-gray-300 @enderror rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">

                                        @if ($this->$newImage)
                                            <div class="relative w-full h-full p-2">
                                                <img src="{{ $this->$newImage->temporaryUrl() }}"
                                                    class="w-full h-full object-cover rounded-xl">
                                                <div
                                                    class="absolute -top-2 -right-2 bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center">
                                                    <i class="fa-solid fa-check text-xs"></i>
                                                </div>
                                            </div>
                                        @elseif ($existingImage)
                                            <div class="relative w-full h-full p-2">
                                                <img src="{{ asset('storage/' . $existingImage) }}"
                                                    class="w-full h-full object-cover rounded-xl">
                                                <div
                                                    class="absolute -top-2 -right-2 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                                    {{ $i }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center">
                                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                                                <p class="text-xs text-gray-500 font-semibold">Gambar
                                                    {{ $i }}</p>
                                                <p class="text-xs text-gray-400">Klik upload</p>
                                            </div>
                                        @endif
                                    </label>

                                    <!-- Loading Indicator -->
                                    <div wire:loading wire:target="newImage{{ $i }}"
                                        class="absolute inset-0 bg-white/90 rounded-2xl flex items-center justify-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div
                                                class="animate-spin rounded-full h-8 w-8 border-2 border-pop-primary border-t-transparent">
                                            </div>
                                            <span class="text-xs font-semibold text-pop-primary">Uploading...</span>
                                        </div>
                                    </div>

                                    @error('newImage' . $i)
                                        <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Status Checkboxes -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Is Active -->
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <input type="checkbox" id="is_active" wire:model="is_active"
                                class="w-5 h-5 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2 cursor-pointer">
                            <label for="is_active"
                                class="text-sm font-semibold text-gray-700 cursor-pointer select-none flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-green-500"></i>
                                Active
                            </label>
                        </div>

                        <!-- Is Featured -->
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <input type="checkbox" id="is_featured" wire:model="is_featured"
                                class="w-5 h-5 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2 cursor-pointer">
                            <label for="is_featured"
                                class="text-sm font-semibold text-gray-700 cursor-pointer select-none flex items-center gap-2">
                                <i class="fa-solid fa-star text-yellow-500"></i>
                                Featured
                            </label>
                        </div>

                        <!-- In Stock -->
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <input type="checkbox" id="in_stock" wire:model="in_stock"
                                class="w-5 h-5 text-pop-primary bg-gray-100 border-gray-300 rounded focus:ring-pop-primary focus:ring-2 cursor-pointer">
                            <label for="in_stock"
                                class="text-sm font-semibold text-gray-700 cursor-pointer select-none flex items-center gap-2">
                                <i class="fa-solid fa-box text-blue-500"></i>
                                In Stock
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div
                    class="p-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 sm:justify-end sticky bottom-0 bg-white rounded-b-3xl">
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
                            class="fa-solid {{ $product_id ? 'fa-pen-to-square' : 'fa-floppy-disk' }}"></i>
                        <span>{{ $product_id ? 'Update Produk' : 'Simpan Produk' }}</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
