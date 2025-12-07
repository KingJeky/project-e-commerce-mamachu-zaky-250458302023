<nav class="navbar-top">
    <div class="flex items-center justify-between">
        <!-- Mobile Burger Button -->
        <a href="#" class="burger-btn">
            <i class="fa-solid fa-bars"></i>
        </a>

        <!-- Page Title / Breadcrumb (Optional) -->
        <div class="hidden md:block">
            <h2 class="text-lg font-bold text-pop-dark">
                @if (request()->routeIs('admin.dashboard'))
                    Dashboard
                @elseif(request()->routeIs('admin.categories*'))
                    Kategori
                @elseif(request()->routeIs('admin.brands*'))
                    Brand
                @elseif(request()->routeIs('admin.products*'))
                    Produk
                @elseif(request()->routeIs('admin.users*'))
                    Users
                @elseif(request()->routeIs('admin.orders*'))
                    Orders
                @else
                    Admin Panel
                @endif
            </h2>
        </div>

        <!-- Right Side Elements (Optional - can add user dropdown, notifications, etc.) -->
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-600 hidden sm:block">
                <i class="fa-solid fa-user-circle text-pop-primary mr-1"></i>
                {{ auth()->user()->name }}
            </span>
        </div>
    </div>
</nav>
