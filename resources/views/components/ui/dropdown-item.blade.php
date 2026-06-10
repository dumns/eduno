@props([
    'href' => null,
    'method' => null,
    'icon' => null,
    'variant' => 'default',
    'class' => '',
])

@php
    $baseClasses = 'group flex items-center w-full gap-3 px-4 py-2.5 text-ui-sm font-medium transition-all duration-150 border-l-[3px] border-transparent';

    $variantClasses = [
        'default' => 'text-foreground dark:text-foreground-dark hover:text-primary dark:hover:text-primary-light hover:bg-primary-light/50 dark:hover:bg-primary-dark/20 hover:border-l-primary',
        'danger' => 'text-danger hover:bg-danger-light dark:hover:bg-danger/20 hover:border-l-danger',
    ];

    $iconColor = [
        'default' => 'text-muted dark:text-muted-dark group-hover:text-primary dark:group-hover:text-primary-light',
        'danger' => 'text-danger/70 group-hover:text-danger',
    ];

    $classes = trim("{$baseClasses} {$variantClasses[$variant]} {$class}");
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes->except(['class', 'href', 'method', 'icon', 'variant']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="{{ $iconColor[$variant] }} flex-shrink-0 transition-colors duration-150" />
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="button" class="{{ $classes }}" {{ $attributes->except(['class', 'href', 'method', 'icon', 'variant']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="{{ $iconColor[$variant] }} flex-shrink-0 transition-colors duration-150" />
        @endif
        <span>{{ $slot }}</span>
    </button>
@endif
