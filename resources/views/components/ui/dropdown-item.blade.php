@props([
    'href' => null,
    'method' => null,
    'icon' => null,
    'variant' => 'default',
    'class' => '',
])

@php
    $baseClasses = 'flex items-center w-full gap-2.5 px-4 py-2.5 text-ui-sm transition-all duration-150';

    $variantClasses = [
        'default' => 'text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800',
        'danger' => 'text-danger hover:bg-danger-light dark:hover:bg-danger/20',
    ];

    $classes = trim("{$baseClasses} {$variantClasses[$variant]} {$class}");
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes->except(['class', 'href', 'method', 'icon', 'variant']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="text-muted dark:text-muted-dark flex-shrink-0" />
        @endif
        {{ $slot }}
    </a>
@else
    <button type="button" class="{{ $classes }}" {{ $attributes->except(['class', 'href', 'method', 'icon', 'variant']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="text-muted dark:text-muted-dark flex-shrink-0" />
        @endif
        {{ $slot }}
    </button>
@endif
