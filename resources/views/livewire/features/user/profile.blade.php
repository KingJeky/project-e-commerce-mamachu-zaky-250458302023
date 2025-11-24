<div>
    <div class="min-h-screen bg-gradient-to-br from-pop-light via-white to-pop-secondary/10 py-20">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Page Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-heading font-bold text-pop-dark mb-2">My Profile</h1>
                <p class="text-gray-600">Kelola informasi profil Anda</p>
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

            <!-- Profile Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header with Avatar -->
                <div class="bg-gradient-to-r from-pop-primary to-red-500 p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>

                    <div class="relative flex flex-col md:flex-row items-center gap-6">
                        <div
                            class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-4xl font-bold shadow-xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="text-center md:text-left">
                            <h2 class="text-3xl font-heading font-bold mb-1">{{ Auth::user()->name }}</h2>
                            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                                <span class="bg-white/20 backdrop-blur-sm px-4 py-1 rounded-full text-sm font-semibold">
                                    <i class="fa-solid fa-user-tag mr-1"></i>
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                                <span class="bg-white/20 backdrop-blur-sm px-4 py-1 rounded-full text-sm">
                                    <i class="fa-solid fa-calendar-days mr-1"></i>
                                    Bergabung sejak {{ Auth::user()->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="p-8">
                    @if (!$editMode)
                        <!-- View Mode -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                                <h3 class="text-xl font-heading font-semibold text-pop-dark">Informasi Profil</h3>
                                <button wire:click="toggleEdit"
                                    class="bg-pop-primary text-white px-6 py-2 rounded-full font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-xl hover:scale-105 transform">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile
                                </button>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div
                                    class="bg-gradient-to-br from-pop-light to-white p-6 rounded-2xl border border-gray-100">
                                    <label class="text-sm text-gray-500 font-semibold mb-2 block">
                                        <i class="fa-solid fa-user text-pop-primary mr-2"></i>Nama Lengkap
                                    </label>
                                    <p class="text-lg font-semibold text-pop-dark">{{ $name }}</p>
                                </div>

                                <!-- Email -->
                                <div
                                    class="bg-gradient-to-br from-pop-light to-white p-6 rounded-2xl border border-gray-100">
                                    <label class="text-sm text-gray-500 font-semibold mb-2 block">
                                        <i class="fa-solid fa-envelope text-pop-primary mr-2"></i>Email
                                    </label>
                                    <p class="text-lg font-semibold text-pop-dark break-all">{{ $email }}</p>
                                </div>

                                <!-- Role -->
                                <div
                                    class="bg-gradient-to-br from-pop-light to-white p-6 rounded-2xl border border-gray-100">
                                    <label class="text-sm text-gray-500 font-semibold mb-2 block">
                                        <i class="fa-solid fa-user-shield text-pop-primary mr-2"></i>Role
                                    </label>
                                    <p class="text-lg font-semibold text-pop-dark">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>

                                <!-- Join Date -->
                                <div
                                    class="bg-gradient-to-br from-pop-light to-white p-6 rounded-2xl border border-gray-100">
                                    <label class="text-sm text-gray-500 font-semibold mb-2 block">
                                        <i class="fa-solid fa-calendar-check text-pop-primary mr-2"></i>Tanggal
                                        Bergabung
                                    </label>
                                    <p class="text-lg font-semibold text-pop-dark">
                                        {{ Auth::user()->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Edit Mode -->
                        <form wire:submit.prevent="updateProfile">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                                    <h3 class="text-xl font-heading font-semibold text-pop-dark">Edit Profil</h3>
                                    <button type="button" wire:click="cancelEdit"
                                        class="text-gray-600 hover:text-gray-800 font-semibold">
                                        <i class="fa-solid fa-times mr-1"></i>Batal
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <!-- Name Input -->
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fa-solid fa-user text-pop-primary mr-2"></i>Nama Lengkap
                                        </label>
                                        <input type="text" id="name" wire:model="name"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('name') border-red-500 @enderror"
                                            placeholder="Masukkan nama lengkap">
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Email Input -->
                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fa-solid fa-envelope text-pop-primary mr-2"></i>Email
                                        </label>
                                        <input type="email" id="email" wire:model="email"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pop-primary focus:border-transparent transition @error('email') border-red-500 @enderror"
                                            placeholder="Masukkan email">
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                                <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-4 pt-4">
                                    <button type="submit"
                                        class="flex-1 bg-pop-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-500 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                                        <i class="fa-solid fa-check mr-2"></i>Simpan Perubahan
                                    </button>
                                    <button type="button" wire:click="cancelEdit"
                                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                                        <i class="fa-solid fa-times mr-2"></i>Batal
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    <!-- Quick Links Section -->
                    @if (!$editMode)
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h4 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-gear text-pop-primary"></i>
                                Pengaturan Tambahan
                            </h4>
                            <div class="grid md:grid-cols-2 gap-4">
                                <a href="{{ route('user.addresses') }}"
                                    class="flex items-center gap-3 p-4 bg-gradient-to-br from-pop-light to-white rounded-xl border border-gray-100 hover:shadow-md transition group">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-pop-primary to-red-500 rounded-full flex items-center justify-center text-white group-hover:scale-110 transition">
                                        <i class="fa-solid fa-location-dot text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-pop-dark">Alamat Saya</p>
                                        <p class="text-sm text-gray-500">Kelola alamat pengiriman</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-pop-primary font-semibold transition">
                    <i class="fa-solid fa-arrow-left"></i>Kembali ke Beranda
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
</div>
