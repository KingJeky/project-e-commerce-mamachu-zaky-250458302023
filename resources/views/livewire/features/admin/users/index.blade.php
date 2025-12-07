<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-2">
                User <span class="text-pop-primary">Management</span>
            </h1>
            <p class="text-gray-600 text-lg">Kelola pengguna aplikasi Anda</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden">

            <!-- Card Header -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Daftar Pengguna</h2>
                        <p class="text-gray-500 text-sm">Kelola semua pengguna aplikasi</p>
                    </div>
                    <button wire:click="create()"
                        class="bg-gradient-to-r from-pop-primary to-red-400 hover:from-red-400 hover:to-pop-primary text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2 w-full sm:w-auto justify-center">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Tambah User</span>
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 md:p-8">

                <!-- Form Modal -->
                @if ($isOpen)
                    <div
                        class="mb-6 p-6 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border-2 border-pop-primary/20">
                        @include('livewire.features.admin.users.form')
                    </div>
                @endif

                <!-- Search Box -->
                <div class="mb-6">
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="w-full px-5 py-3 pl-12 rounded-full border-2 border-gray-200 focus:border-pop-primary focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all"
                            placeholder="Cari pengguna berdasarkan nama atau email...">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">No</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Name</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Email</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Role</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Joined At</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr
                                    class="border-b border-gray-100 hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-red-50/50 transition-all duration-200">
                                    <td class="py-4 px-4">
                                        <span
                                            class="font-semibold text-gray-700">{{ $users->firstItem() + $index }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br from-pop-primary to-red-400 flex items-center justify-center text-white font-bold shadow-md">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-bold text-pop-dark">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-gray-600 text-sm">{{ $user->email }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($user->role === 'admin')
                                            <span
                                                class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-crown"></i>
                                                Admin
                                            </span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-user"></i>
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="text-gray-600 text-sm">{{ $user->created_at->format('d F Y') }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex gap-2">
                                            <button wire:click="edit('{{ $user->id }}')"
                                                class="bg-blue-500 hover:bg-blue-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button x-data
                                                x-on:click.prevent="
                                                Swal.fire({
                                                    title: 'Yakin hapus pengguna?',
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
                                                        @this.call('delete', '{{ $user->id }}');
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
                                            <i class="fa-solid fa-users-slash text-gray-300 text-5xl mb-4"></i>
                                            <p class="text-gray-500 font-semibold">Belum ada pengguna</p>
                                            <p class="text-gray-400 text-sm mt-1">Tambahkan pengguna pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center sm:justify-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
