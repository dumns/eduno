@props([
    'brand' => null,
    'brandRoute' => '/',
    'class' => '',
    'sticky' => true,
])

<nav class="{{ $sticky ? 'sticky top-0 z-50' : '' }} bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark {{ $class }}"
    {{ $attributes->except(['class', 'brand', 'brandRoute', 'sticky']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ $brandRoute }}" class="flex items-center gap-2.5">
                    @if ($brand)
                        {{ $brand }}
                    @else
                        <span class="text-ui-lg font-bold text-foreground dark:text-foreground-dark">{{ config('app.name') }}</span>
                    @endif
                </a>

                @isset($nav)
                    <div class="hidden md:flex items-center gap-2">
                        {{ $nav }}
                    </div>
                @endisset
            </div>

            <div class="flex items-center gap-2">
                @isset($actions)
                    {{ $actions }}
                @endisset

                @isset($mobileNav)
                    <div x-data="{ open: false }" class="md:hidden relative">
                        <button @click="open = !open" type="button" class="p-2 rounded-ui-xl text-muted dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all duration-150">
                            <x-ui.icon name="menu" size="md" />
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition-all duration-200 ease-out"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition-all duration-150 ease-in"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-full mt-1 w-56 bg-white dark:bg-surface-dark rounded-ui-xl ring-1 ring-black/5 dark:ring-white/10"
                            @click.outside="open = false"
                            style="display: none;">
                            <div class="py-1">
                                {{ $mobileNav }}
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</nav>
