@props([
    'class' => '',
    'collapsible' => true,
])

<aside class="bg-white dark:bg-surface-dark border-r border-border dark:border-border-dark {{ $class }}"
    x-data="{ collapsed: false }"
    {{ $attributes->except(['class', 'collapsible']) }}>
    <div class="flex flex-col h-full" :class="collapsed ? 'w-16' : 'w-64'" class="transition-all duration-200">
        @isset($header)
            <div class="flex items-center justify-between h-16 px-4 border-b border-border dark:border-border-dark">
                <div :class="collapsed ? 'hidden' : 'block'">
                    {{ $header }}
                </div>
                @if ($collapsible)
                    <button @click="collapsed = !collapsed" type="button" class="p-1.5 rounded-ui-lg text-muted dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                        <x-ui.icon name="chevron-left" size="sm" x-show="!collapsed" />
                        <x-ui.icon name="chevron-right" size="sm" x-show="collapsed" />
                    </button>
                @endif
            </div>
        @endisset

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 ui-scrollbar">
            {{ $slot }}
        </nav>

        @isset($footer)
            <div class="px-4 py-4 border-t border-border dark:border-border-dark">
                {{ $footer }}
            </div>
        @endisset
    </div>
</aside>
