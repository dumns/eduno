@props([
    'level' => 'h2',
    'size' => null,
    'weight' => 'semibold',
    'color' => null,
    'class' => '',
])

@php
    $sizeMap = [
        'h1' => 'text-ui-4xl',
        'h2' => 'text-ui-3xl',
        'h3' => 'text-ui-2xl',
        'h4' => 'text-ui-xl',
        'h5' => 'text-ui-lg',
        'h6' => 'text-ui-base',
    ];

    $weightMap = [
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        'extrabold' => 'font-extrabold',
    ];

    $colorMap = [
        'default' => 'text-foreground dark:text-foreground-dark',
        'primary' => 'text-primary dark:text-primary-light',
        'secondary' => 'text-secondary dark:text-secondary-light',
        'muted' => 'text-muted dark:text-muted-dark',
        'white' => 'text-white',
    ];

    $textSize = $size ?? $sizeMap[$level];
    $textColor = $color ? ($colorMap[$color] ?? $colorMap['default']) : $colorMap['default'];
    $fontWeight = $weightMap[$weight];
@endphp

<{{ $level }} class="{{ $textSize }} {{ $fontWeight }} {{ $textColor }} tracking-tight {{ $class }}"
    {{ $attributes->except(['class', 'level', 'size', 'weight', 'color']) }}>
    {{ $slot }}
</{{ $level }}>
