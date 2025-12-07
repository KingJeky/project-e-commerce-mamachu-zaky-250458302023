<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-2">
                Product <span class="text-pop-primary">Management</span>
            </h1>
            <p class="text-gray-600 text-lg">Kelola produk minuman Anda</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden">

            <!-- Card Header -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Daftar Produk</h2>
                        <p class="text-gray-500 text-sm">Kelola semua produk minuman Anda</p>
                    </div>
                    <button wire:click="create()"
                        class="bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2 w-full sm:w-auto justify-center">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Tambah Produk</span>
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 md:p-8">

                <!-- Form Modal -->
                @if ($isOpen)
                    <div
                        class="mb-6 p-6 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border-2 border-pop-primary/20">
                        @include('livewire.features.admin.products.form')
                    </div>
                @endif

                <!-- Image Modal -->
                @if ($showImageModal)
                    <div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.8);">
                        <div class="flex items-center justify-center min-h-screen px-4 py-8">
                            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl transform transition-all"
                                x-data="{ currentSlide: 0, totalSlides: {{ count($viewingImages ?? []) }} }">
                                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                                    <h3 class="text-2xl font-heading font-bold text-pop-dark">📸 Gambar Produk</h3>
                                    <button type="button" wire:click="closeImageModal"
                                        class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-2xl"></i>
                                    </button>
                                </div>
                                <div class="p-8">
                                    @if (!empty($viewingImages))
                                        <div class="relative">
                                            <!-- Carousel Images -->
                                            <div class="overflow-hidden rounded-2xl bg-gray-50">
                                                @foreach ($viewingImages as $index => $image)
                                                    <div x-show="currentSlide === {{ $index }}"
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 transform scale-95"
                                                        x-transition:enter-end="opacity-100 transform scale-100"
                                                        class="flex items-center justify-center p-4">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="w-full h-auto max-h-[32rem] object-contain rounded-xl shadow-lg"
                                                            alt="Product Image {{ $index + 1 }}">
                                                    </div>
                                                @endforeach
                                            </div>

                                            @if (count($viewingImages) > 1)
                                                <!-- Previous Button -->
                                                <button
                                                    @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1"
                                                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-pop-dark w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all hover:scale-110">
                                                    <i class="fa-solid fa-chevron-left text-xl"></i>
                                                </button>

                                                <!-- Next Button -->
                                                <button
                                                    @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0"
                                                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-pop-dark w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all hover:scale-110">
                                                    <i class="fa-solid fa-chevron-right text-xl"></i>
                                                </button>
                                            @endif
                                            @if (count($viewingImages) > 1)
                                                <!-- Dots Indicator -->
                                                <div class="flex justify-center gap-2 mt-6">
                                                    @foreach ($viewingImages as $index => $image)
                                                        <button @click="currentSlide = {{ $index }}"
                                                            :class="currentSlide === {{ $index }} ?
                                                                'bg-pop-primary w-8' : 'bg-gray-300 w-3'"
                                                            class="h-3 rounded-full transition-all duration-300"></button>
                                                    @endforeach
                                                </div>

                                                <!-- Counter -->
                                                <div class="text-center mt-4">
                                                    <span class="text-sm font-semibold text-gray-600">
                                                        Gambar <span x-text="currentSlide + 1"></span> dari <span
                                                            x-text="totalSlides"></span>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-12">
                                            <i class="fa-solid fa-image text-gray-300 text-5xl mb-4"></i>
                                            <p class="text-gray-500 font-semibold">Tidak ada gambar untuk produk ini.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 border-t border-gray-100 flex justify-end gap-3">
                                    @if (count($viewingImages ?? []) > 1)
                                        <div class="flex items-center gap-2 mr-auto">
                                            <button
                                                @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1"
                                                class="px-4 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all flex items-center gap-2">
                                                <i class="fa-solid fa-chevron-left"></i>
                                                <span>Prev</span>
                                            </button>
                                            <button
                                                @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0"
                                                class="px-4 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all flex items-center gap-2">
                                                <span>Next</span>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <button wire:click="closeImageModal"
                                        class="px-6 py-3 rounded-full bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white font-bold shadow-lg transition-all">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Status Modal -->
                @if ($showStatusModal && $viewingStatusProduct)
                    <div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
                        <div class="flex items-center justify-center min-h-screen px-4 py-8">
                            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md transform transition-all">
                                <div class="p-6 border-b border-gray-100">
                                    <h3 class="text-xl font-heading font-bold text-pop-dark">Status:
                                        {{ $viewingStatusProduct->name }}</h3>
                                </div>
                                <div class="p-6 space-y-3">
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="font-semibold text-gray-700">Is Active</span>
                                        @if ($viewingStatusProduct->is_active)
                                            <span
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i> Yes
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-xmark"></i> No
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="font-semibold text-gray-700">Is Featured</span>
                                        @if ($viewingStatusProduct->is_featured)
                                            <span
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-star"></i> Yes
                                            </span>
                                        @else
                                            <span
                                                class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">No</span>
                                        @endif
                                    </div>
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                        <span class="font-semibold text-gray-700">In Stock</span>
                                        @if ($viewingStatusProduct->in_stock)
                                            <span
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i> Yes
                                            </span>
                                        @else
                                            <span
                                                class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-triangle-exclamation"></i> No
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-6 border-t border-gray-100 flex justify-end">
                                    <button wire:click="closeStatusModal"
                                        class="px-6 py-3 rounded-full border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Search Box -->
                <div class="mb-6">
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="w-full px-5 py-3 pl-12 rounded-full border-2 border-gray-200 focus:border-pop-primary focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all"
                            placeholder="Cari produk berdasarkan nama...">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">No</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Image</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Name</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Category</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Price</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Status</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr
                                    class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-red-50/50 transition-all duration-200">
                                    <td class="py-4 px-4">
                                        <span
                                            class="font-semibold text-gray-700">{{ $products->firstItem() + $index }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($product->images && !empty($product->images))
                                            <button wire:click="viewImages('{{ $product->id }}')"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition-all duration-200 hover:scale-105 flex items-center gap-1">
                                                <i class="fa-solid fa-images"></i>
                                                <span>Lihat</span>
                                            </button>
                                        @else
                                            <div
                                                class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                                <i class="fa-solid fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-pop-dark">{{ $product->name }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-gray-600 text-sm">{{ $product->category->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-green-600">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button wire:click="viewStatus('{{ $product->id }}')"
                                            class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition-all duration-200 hover:scale-105 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>Status</span>
                                        </button>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex gap-2">
                                            <button wire:click="edit('{{ $product->id }}')"
                                                class="bg-blue-500 hover:bg-blue-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button x-data
                                                x-on:click.prevent="
                                                Swal.fire({
                                                    title: 'Yakin hapus produk?',
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
                                                        @this.call('delete', '{{ $product->id }}');
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
                                            <i class="fa-solid fa-inbox text-gray-300 text-5xl mb-4"></i>
                                            <p class="text-gray-500 font-semibold">Belum ada produk</p>
                                            <p class="text-gray-400 text-sm mt-1">Tambahkan produk pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center sm:justify-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
