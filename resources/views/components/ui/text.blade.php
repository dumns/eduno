@props([
    'size' => 'base',
    'weight' => 'normal',
    'color' => 'default',
    'align' => null,
    'leading' => null,
    'class' => '',
])

@php
    $sizeClasses = [
        'xs' => 'text-ui-xs',
        'sm' => 'text-ui-sm',
        'base' => 'text-ui-base',
        'lg' => 'text-ui-lg',
        'xl' => 'text-ui-xl',
        '2xl' => 'text-ui-2xl',
    ];

    $weightClasses = [
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
    ];

    $colorClasses = [
        'default' => 'text-foreground dark:text-foreground-dark',
        'muted' => 'text-muted dark:text-muted-dark',
        'primary' => 'text-primary dark:text-primary-light',
        'success' => 'text-success',
        'danger' => 'text-danger',
        'warning' => 'text-warning',
        'info' => 'text-info',
        'white' => 'text-white',
    ];

    $alignClasses = $align ? "text-{$align}" : '';

    $leadingClasses = [
        'none' => 'leading-none',
        'tight' => 'leading-tight',
        'snug' => 'leading-snug',
        'normal' => 'leading-normal',
        'relaxed' => 'leading-relaxed',
        'loose' => 'leading-loose',
    ];
@endphp

<p class="{{ $sizeClasses[$size] }} {{ $weightClasses[$weight] }} {{ $colorClasses[$color] }} {{ $alignClasses }} {{ $leading ? $leadingClasses[$leading] : '' }} {{ $class }}"
    {{ $attributes->except(['class', 'size', 'weight', 'color', 'align', 'leading']) }}>
    {{ $slot }}
</p>
