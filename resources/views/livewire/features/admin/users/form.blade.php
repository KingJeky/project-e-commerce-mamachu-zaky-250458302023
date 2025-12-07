<div class="fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl transform transition-all">

            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-heading font-bold text-pop-dark">
                        {{ $user_id ? '✏️ Edit User' : '➕ Tambah User Baru' }}
                    </h3>
                    <button type="button" wire:click="closeModal"
                        class="text-gray-400 hover:text-pop-primary transition-colors w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>
                <p class="text-gray-500 text-sm mt-1">Lengkapi informasi pengguna</p>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="store">
                <div class="p-6 space-y-5">

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-pop-primary">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" id="name" wire:model="name" placeholder="Contoh: John Doe"
                                class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('name') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                            Email <span class="text-pop-primary">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" id="email" wire:model="email" placeholder="user@example.com"
                                class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('email') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                            Password @if (!$user_id)
                                <span class="text-pop-primary">*</span>
                            @endif
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" id="password" wire:model="password"
                                placeholder="{{ $user_id ? 'Kosongkan jika tidak ingin mengubah password' : 'Minimal 6 karakter' }}"
                                class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('password') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all">
                        </div>
                        @if ($user_id)
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fa-solid fa-circle-info"></i>
                                Kosongkan jika tidak ingin mengubah password
                            </p>
                        @endif
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-gray-700 mb-2">
                            Role <span class="text-pop-primary">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-shield-halved"></i>
                            </span>
                            <select id="role" wire:model="role"
                                class="w-full px-4 py-3 pl-12 rounded-xl border-2 @error('role') border-red-300 focus:border-red-400 @else border-gray-200 focus:border-pop-primary @enderror focus:ring-4 focus:ring-pop-primary/10 outline-none transition-all appearance-none bg-white cursor-pointer">
                                <option value="">Pilih Role</option>
                                <option value="admin">👑 Admin</option>
                                <option value="user">👤 User</option>
                            </select>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>
                        @error('role')
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
                            class="animate-spin rounded-full h-4 w-4 border-2 border-white border-t-transparent"></div>
                        <i wire:loading.remove wire:target="store"
                            class="fa-solid {{ $user_id ? 'fa-pen-to-square' : 'fa-user-plus' }}"></i>
                        <span>{{ $user_id ? 'Update User' : 'Simpan User' }}</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
