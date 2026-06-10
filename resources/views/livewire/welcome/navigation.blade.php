<nav class="fixed top-0 right-0 p-6 z-10">
    @auth
        <x-ui.button href="{{ url('/dashboard') }}" variant="ghost" size="sm">Dasbor</x-ui.button>
    @else
        <div class="flex items-center gap-3">
            <x-ui.button href="{{ route('login') }}" variant="ghost" size="sm">Masuk</x-ui.button>
            @if (Route::has('register'))
                <x-ui.button href="{{ route('register') }}" size="sm">Daftar</x-ui.button>
            @endif
        </div>
    @endauth
</nav>
