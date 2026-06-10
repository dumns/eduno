@props([
    'align' => 'left',
    'width' => '48',
    'contentClasses' => '',
    'trigger' => null,
    'class' => '',
])

@php
    $alignmentClasses = [
        'left' => 'origin-top-left left-0',
        'right' => 'origin-top-right right-0',
        'top' => 'origin-bottom-left bottom-full mb-2 left-0',
    ][$align];

    $widthClasses = [
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
        '72' => 'w-72',
        'auto' => 'w-auto',
    ][$width];
@endphp

<div class="relative {{ $class }}" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false"
    {{ $attributes->except(['class', 'align', 'width', 'contentClasses', 'trigger']) }}>
    <div @click="open = ! open">
        @if ($trigger)
            {{ $trigger }}
        @else
            <button type="button" class="inline-flex items-center gap-2 px-3 py-2 text-ui-sm font-medium text-foreground dark:text-foreground-dark rounded-ui-xl hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all duration-150">
                {{ $slot }}
                <x-ui.icon name="chevron-down" size="xs" class="text-muted dark:text-muted-dark" />
            </button>
        @endif
    </div>

    <div x-show="open"
        x-transition:enter="transition-all duration-150 ease-out"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition-all duration-100 ease-in"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-1 {{ $alignmentClasses }} {{ $widthClasses }} rounded-ui-xl bg-white dark:bg-surface-dark ring-1 ring-black/5 dark:ring-white/10 {{ $contentClasses }}"
        @click="open = false"
        style="display: none;">
        <div class="py-1">
            {{ $slot }}
        </div>
    </div>
</div>
