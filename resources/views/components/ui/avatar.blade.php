@props([
    'src' => null,
    'alt' => '',
    'size' => 'md',
    'status' => null,
    'initials' => null,
    'class' => '',
])

@php
    $baseClasses = 'relative inline-flex items-center justify-center rounded-full bg-primary-light text-primary-dark dark:bg-primary-dark/40 dark:text-primary-light font-semibold flex-shrink-0 overflow-hidden';

    $sizeClasses = [
        'xs' => 'h-6 w-6 text-ui-xs',
        'sm' => 'h-8 w-8 text-ui-sm',
        'md' => 'h-10 w-10 text-ui-base',
        'lg' => 'h-12 w-12 text-ui-lg',
        'xl' => 'h-16 w-16 text-ui-xl',
        '2xl' => 'h-20 w-20 text-ui-2xl',
    ];

    $statusPositions = [
        'xs' => '-right-0.5 -bottom-0.5 h-2 w-2',
        'sm' => '-right-0.5 -bottom-0.5 h-2.5 w-2.5',
        'md' => '-right-0.5 -bottom-0.5 h-3 w-3',
        'lg' => '-right-0.5 -bottom-0.5 h-3.5 w-3.5',
        'xl' => '-right-1 -bottom-1 h-4 w-4',
        '2xl' => '-right-1 -bottom-1 h-5 w-5',
    ];

    $statusColors = [
        'online' => 'bg-success',
        'offline' => 'bg-gray-400',
        'away' => 'bg-warning',
        'busy' => 'bg-danger',
    ];
@endphp

<div class="{{ $baseClasses }} {{ $sizeClasses[$size] }} {{ $class }}"
    {{ $attributes->except(['class', 'src', 'alt', 'size', 'status', 'initials']) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="h-full w-full object-cover rounded-full">
    @elseif ($initials)
        <span>{{ $initials }}</span>
    @else
        <svg class="h-1/2 w-1/2 text-current opacity-60" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
        </svg>
    @endif

    @if ($status)
        <span class="absolute {{ $statusPositions[$size] }} rounded-full border-2 border-white dark:border-surface-dark {{ $statusColors[$status] }}"></span>
    @endif
</div>
