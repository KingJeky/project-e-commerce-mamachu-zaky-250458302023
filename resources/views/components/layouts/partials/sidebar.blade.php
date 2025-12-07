<div id="sidebar">
    <div class="sidebar-wrapper" x-data>
        <!-- Sidebar Header with Logo -->
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <div class="logo-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
                <span>Mamachu</span>
            </a>
            <a href="#" class="sidebar-hide">
                <i class="bi bi-x text-2xl text-gray-600 hover:text-pop-primary transition-colors"></i>
            </a>
        </div>

        <!-- User Profile Card -->
        <div class="sidebar-user-card">
            <div class="flex items-center gap-3">
                <img src="{{ asset('mazer/assets/compiled/jpg/1.jpg') }}" alt="User Avatar" class="sidebar-user-avatar">
                <div class="flex-1">
                    <h5 class="font-bold text-gray-800 text-sm mb-1">{{ auth()->user()->name }}</h5>
                    <span class="user-role-badge">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Dashboard</li>

                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title" style="margin-top: 1.5rem;">Master Data</li>

                <li class="sidebar-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories') }}" class='sidebar-link'>
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands') }}" class='sidebar-link'>
                        <i class="fa-solid fa-bookmark"></i>
                        <span>Brand</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products') }}" class='sidebar-link'>
                        <i class="fa-solid fa-box"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}" class='sidebar-link'>
                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders') }}" class='sidebar-link'>
                        <i class="fa-solid fa-receipt"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="sidebar-item" style="margin-top: 2rem;">
                    <a href="#" class="sidebar-link logout-link"
                        x-on:click.prevent="
                        Swal.fire({
                            title: 'Anda Yakin?',
                            text: 'Anda akan keluar dari sesi ini.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#FF6B6B',
                            cancelButtonColor: '#6B7280',
                            confirmButtonText: 'Ya, Keluar!',
                            cancelButtonText: 'Batal',
                            iconColor: '#FF6B6B',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $dispatch('logout')
                            }
                        })
                    ">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
