@props([
    'name' => '',
    'size' => 'md',
    'variant' => 'duotone',
    'class' => '',
])

@php
    $sizeClasses = [
        'xs' => 'h-3 w-3',
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
        'xl' => 'h-8 w-8',
        '2xl' => 'h-10 w-10',
    ];

    $zappiconMap = [
        'search' => 'search',
        'plus' => 'plus',
        'edit' => 'pen-line',
        'trash' => 'trash',
        'close' => 'xmark',
        'check' => 'check-circle',
        'chevron-down' => 'angle-down-small',
        'chevron-up' => 'angle-up-small',
        'chevron-left' => 'angle-left-small',
        'chevron-right' => 'angle-right-small',
        'eye' => 'eye',
        'eye-off' => 'eye-slash',
        'mail' => 'envelope',
        'lock' => 'lock-simple',
        'user' => 'user',
        'settings' => 'gear',
        'bell' => 'bell',
        'menu' => 'menu-bars',
        'download' => 'download-bracket',
        'upload' => 'upload-bracket',
        'filter' => 'filter',
        'sort' => 'sort',
        'info' => 'info-circle',
        'alert-triangle' => 'exclamation-triangle',
        'external-link' => 'link-simple',
        'home' => 'house',
        'play' => 'play',
        'calendar' => 'calendar',
        'clock' => 'clock',
        'star' => 'star',
        'book' => 'book-simple',
        'check-circle' => 'check-circle',
        'x-circle' => 'xmark-circle',
        'alert-circle' => 'exclamation-circle',
        'image' => 'image',
        'camera' => 'camera',
        'heart' => 'heart-simple',
        'share' => 'share',
        'copy' => 'copy',
        'credit-card' => 'credit-card',
        'check-badge' => 'check-circle',
        'arrow-right' => 'arrow-right-small',
        'code-bracket' => 'code',
        'beaker' => 'flask',
        'refresh' => 'arrows-rotate',
        'list-bullet' => 'list',
    ];

    $zappiconName = $zappiconMap[$name] ?? $name;
@endphp

@if ($zappiconName)
    <i class="za-{{ $zappiconName }}-{{ $variant }} {{ $sizeClasses[$size] }} {{ $class }} flex-shrink-0"
        {{ $attributes->except(['class', 'name', 'size', 'variant']) }}></i>
@else
    <span class="{{ $sizeClasses[$size] }} {{ $class }} flex-shrink-0" {{ $attributes->except(['class', 'name', 'size', 'variant']) }}></span>
@endif
