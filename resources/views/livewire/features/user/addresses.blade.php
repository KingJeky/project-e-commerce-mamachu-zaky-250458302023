<div>
    <div class="min-h-screen bg-gradient-to-br from-pop-light via-white to-pop-secondary/10 py-20">
        <div class="container mx-auto px-6 max-w-6xl">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h1 class="text-4xl font-heading font-bold text-pop-dark mb-2">Alamat Saya</h1>
                    <p class="text-gray-600">Kelola alamat pengiriman untuk order Anda</p>
                </div>
                @if (!$showForm)
                    <button wire:click="showCreateForm"
                        class="bg-pop-primary text-white px-6 py-3 rounded-full font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fa-solid fa-plus mr-2"></i>Tambah Alamat Baru
                    </button>
                @endif
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-2xl"></i>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($showForm)
                <!-- Create/Edit Form -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 animate-fade-in">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-heading font-bold text-pop-dark">
                            {{ $editMode ? 'Edit Alamat' : 'Tambah Alamat Baru' }}
                        </h2>
                        <button wire:click="cancelForm" class="text-gray-600 hover:text-gray-800">
                            <i class="fa-solid fa-times text-2xl"></i>
                        </button>
                    </div>

                    <form wire:submit.prevent="saveAddress" class="space-y-4">
                        <!-- Label -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-tag text-pop-primary mr-2"></i>Label Alamat
                            </label>
                            <select wire:model="label"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('label') border-red-500 @enderror">
                                <option value="Rumah">Rumah</option>
                                <option value="Kantor">Kantor</option>
                                <option value="Apartemen">Apartemen</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('label')
                                <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name Fields -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-user text-pop-primary mr-2"></i>Nama Depan
                                </label>
                                <input type="text" wire:model="first_name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('first_name') border-red-500 @enderror"
                                    placeholder="Nama depan penerima">
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-user text-pop-primary mr-2"></i>Nama Belakang (Opsional)
                                </label>
                                <input type="text" wire:model="last_name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition"
                                    placeholder="Nama belakang penerima">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-phone text-pop-primary mr-2"></i>No. Telepon
                            </label>
                            <input type="text" wire:model="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('phone') border-red-500 @enderror"
                                placeholder="08123456789">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Street Address -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-location-dot text-pop-primary mr-2"></i>Alamat Lengkap
                            </label>
                            <textarea wire:model="street_address" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('street_address') border-red-500 @enderror"
                                placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan"></textarea>
                            @error('street_address')
                                <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City, State, Zip -->
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-city text-pop-primary mr-2"></i>Kota
                                </label>
                                <input type="text" wire:model="city"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('city') border-red-500 @enderror"
                                    placeholder="Jakarta">
                                @error('city')
                                    <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-map text-pop-primary mr-2"></i>Provinsi (Opsional)
                                </label>
                                <input type="text" wire:model="state"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition"
                                    placeholder="DKI Jakarta">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-envelope text-pop-primary mr-2"></i>Kode Pos
                                </label>
                                <input type="text" wire:model="zip_code"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('zip_code') border-red-500 @enderror"
                                    placeholder="12345">
                                @error('zip_code')
                                    <p class="mt-2 text-sm text-red-600"><i class="fa-solid fa-circle-exclamation"></i>
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Is Default -->
                        <div class="flex items-center gap-3 p-4 bg-pop-light rounded-xl">
                            <input type="checkbox" wire:model="is_default" id="is_default"
                                class="w-5 h-5 text-pop-primary rounded focus:ring-pop-primary">
                            <label for="is_default" class="font-semibold text-gray-700 cursor-pointer">
                                <i class="fa-solid fa-star text-pop-primary mr-2"></i>Jadikan sebagai alamat default
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit"
                                class="flex-1 bg-pop-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i
                                    class="fa-solid fa-check mr-2"></i>{{ $editMode ? 'Update Alamat' : 'Simpan Alamat' }}
                            </button>
                            <button type="button" wire:click="cancelForm"
                                class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                                <i class="fa-solid fa-times mr-2"></i>Batal
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            @if ($addresses->isEmpty() && !$showForm)
                <!-- Empty State -->
                <div class="bg-white rounded-3xl shadow-2xl p-12 text-center">
                    <div class="w-32 h-32 bg-pop-light rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-location-dot text-6xl text-pop-primary"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-pop-dark mb-3">Belum Ada Alamat</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Anda belum menambahkan alamat pengiriman. Tambahkan alamat pertama Anda untuk memudahkan proses
                        pemesanan.
                    </p>
                    <button wire:click="showCreateForm"
                        class="bg-pop-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fa-solid fa-plus mr-2"></i>Tambah Alamat Pertama
                    </button>
                </div>
            @else
                <!-- Address Cards Grid -->
                @if (!$showForm)
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach ($addresses as $address)
                            <div
                                class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition {{ $address->is_default ? 'ring-2 ring-pop-primary' : '' }}">
                                <!-- Header -->
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="bg-gradient-to-r from-pop-primary to-red-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                                            {{ $address->label }}
                                        </span>
                                        @if ($address->is_default)
                                            <span
                                                class="bg-pop-secondary text-pop-dark px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fa-solid fa-star"></i> Default
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex gap-2">
                                        <button wire:click="showEditForm({{ $address->id }})"
                                            class="text-pop-primary hover:text-red-500 transition">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $address->id }})"
                                            class="text-gray-400 hover:text-red-500 transition">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Address Info -->
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-user text-pop-primary mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-pop-dark">{{ $address->full_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $address->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-location-dot text-pop-primary mt-1"></i>
                                        <p class="text-gray-700">{{ $address->full_address }}</p>
                                    </div>
                                </div>

                                <!-- Set Default Button -->
                                @if (!$address->is_default)
                                    <button wire:click="setDefaultAddress({{ $address->id }})"
                                        class="w-full mt-4 py-2 border-2 border-pop-primary text-pop-primary rounded-xl font-semibold hover:bg-pop-primary hover:text-white transition">
                                        <i class="fa-solid fa-star mr-2"></i>Jadikan Default
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('user.profile') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-pop-primary font-semibold transition">
                    <i class="fa-solid fa-arrow-left"></i>Kembali ke Profile
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>

    <script>
        function confirmDelete(addressId) {
            Swal.fire({
                title: 'Hapus Alamat?',
                text: 'Apakah Anda yakin ingin menghapus alamat ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF6B6B',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteAddress', addressId);
                }
            });
        }
    </script>
</div>
