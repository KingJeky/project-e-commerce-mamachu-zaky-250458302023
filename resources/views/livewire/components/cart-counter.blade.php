<a href="{{ route('user.cart') }}" class="relative text-gray-600 hover:text-pop-primary transition group">
    <i class="fa-solid fa-cart-shopping text-xl"></i>
    @if ($cartCount > 0)
        <span
            class="absolute -top-2 -right-2 bg-pop-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center group-hover:scale-110 transition">
            {{ $cartCount }}
        </span>
    @else
        <span
            class="absolute -top-2 -right-2 bg-gray-400 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
            0
        </span>
    @endif
</a>
