<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-2">
                Category <span class="text-pop-primary">Management</span>
            </h1>
            <p class="text-gray-600 text-lg">Kelola kategori produk minuman Anda</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden">

            <!-- Card Header -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Daftar Kategori</h2>
                        <p class="text-gray-500 text-sm">Kelola semua kategori produk Anda</p>
                    </div>
                    <button wire:click="create()"
                        class="bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2 w-full sm:w-auto justify-center">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Tambah Kategori</span>
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 md:p-8">

                <!-- Success Message -->
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="mb-6 p-4 bg-green-50 border-2 border-green-200 rounded-2xl flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>
                        <span class="text-green-700 font-semibold">{{ session('message') }}</span>
                    </div>
                @endif

                <!-- Form Modal -->
                @if ($isOpen)
                    <div
                        class="mb-6 p-6 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border-2 border-pop-primary/20">
                        @include('livewire.features.admin.categories.form')
                    </div>
                @endif

                <!-- Search Box -->
                <div class="mb-6">
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="w-full px-5 py-3 pl-12 rounded-full border-2 border-gray-200 focus:border-pop-primary focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all"
                            placeholder="Cari kategori berdasarkan nama...">
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
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Slug</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Status</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories as $index => $category)
                                <tr
                                    class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-red-50/50 transition-all duration-200">
                                    <td class="py-4 px-4">
                                        <span
                                            class="font-semibold text-gray-700">{{ $categories->firstItem() + $index }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($category->image)
                                            <div
                                                class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    alt="{{ $category->name }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div
                                                class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                                <i class="fa-solid fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-pop-dark">{{ $category->name }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-gray-600 font-mono text-sm bg-gray-100 px-3 py-1 rounded-full">{{ $category->slug }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($category->is_active)
                                            <span
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex gap-2">
                                            <button wire:click="edit('{{ $category->id }}')"
                                                class="bg-blue-500 hover:bg-blue-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button x-data
                                                x-on:click.prevent="
                                                Swal.fire({
                                                    title: 'Yakin hapus kategori?',
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
                                                        @this.call('delete', '{{ $category->id }}');
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
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fa-solid fa-inbox text-gray-300 text-5xl mb-4"></i>
                                            <p class="text-gray-500 font-semibold">Belum ada kategori</p>
                                            <p class="text-gray-400 text-sm mt-1">Tambahkan kategori pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center sm:justify-end">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
