@props([
    'variant' => 'primary',
    'size' => 'sm',
    'dot' => false,
    'class' => '',
])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-full';

    $variantClasses = [
        'primary' => 'bg-primary-light text-primary-dark dark:bg-primary-dark/30 dark:text-primary-light',
        'secondary' => 'bg-secondary-light text-secondary-hover dark:bg-secondary/20 dark:text-secondary-light',
        'success' => 'bg-success-light text-success-hover dark:bg-success/20 dark:text-success-light',
        'danger' => 'bg-danger-light text-danger-hover dark:bg-danger/20 dark:text-danger-light',
        'warning' => 'bg-warning-light text-warning-hover dark:bg-warning/20 dark:text-warning-light',
        'info' => 'bg-info-light text-info-hover dark:bg-info/20 dark:text-info-light',
        'neutral' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
    ];

    $sizeClasses = [
        'xs' => 'px-1.5 py-0.5 text-ui-xs',
        'sm' => 'px-2.5 py-0.5 text-ui-xs',
        'md' => 'px-3 py-1 text-ui-sm',
        'lg' => 'px-4 py-1.5 text-ui-sm',
    ];

    $dotColors = [
        'primary' => 'bg-primary',
        'secondary' => 'bg-secondary',
        'success' => 'bg-success',
        'danger' => 'bg-danger',
        'warning' => 'bg-warning',
        'info' => 'bg-info',
        'neutral' => 'bg-gray-400 dark:bg-gray-500',
    ];
@endphp

<span class="{{ $baseClasses }} {{ $variantClasses[$variant] }} {{ $sizeClasses[$size] }} {{ $class }}"
    {{ $attributes->except(['class', 'variant', 'size', 'dot']) }}>
    @if ($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColors[$variant] }} mr-1.5 flex-shrink-0"></span>
    @endif
    {{ $slot }}
</span>
