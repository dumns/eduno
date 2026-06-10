@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'loading' => false,
    'disabled' => false,
    'type' => 'submit',
    'href' => null,
    'class' => '',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold border border-transparent rounded-ui-lg focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-surface-dark transition-all duration-150 select-none';

    $variantClasses = [
        'primary' => 'bg-primary text-white hover:bg-primary-hover focus:ring-primary active:bg-primary-dark',
        'secondary' => 'bg-secondary text-white hover:bg-secondary-hover focus:ring-secondary',
        'success' => 'bg-success text-white hover:bg-success-hover focus:ring-success',
        'danger' => 'bg-danger text-white hover:bg-danger-hover focus:ring-danger',
        'warning' => 'bg-warning text-white hover:bg-warning-hover focus:ring-warning',
        'outline' => 'bg-transparent text-primary border-primary hover:bg-primary-light dark:text-primary-light dark:border-primary-light dark:hover:bg-primary-dark/20 focus:ring-primary',
        'ghost' => 'bg-transparent text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:ring-gray-400',
    ];

    $sizeClasses = [
        'xs' => 'px-2.5 py-1.5 text-ui-xs gap-1.5 rounded-ui-md',
        'sm' => 'px-3 py-2 text-ui-sm gap-2 rounded-ui-lg',
        'md' => 'px-4 py-2.5 text-ui-sm gap-2.5 rounded-ui-lg',
        'lg' => 'px-5 py-3 text-ui-base gap-3 rounded-ui-xl',
        'xl' => 'px-6 py-3.5 text-ui-lg gap-3 rounded-ui-xl',
    ];

    $iconSizeClasses = [
        'xs' => 'h-3.5 w-3.5',
        'sm' => 'h-4 w-4',
        'md' => 'h-4 w-4',
        'lg' => 'h-5 w-5',
        'xl' => 'h-5 w-5',
    ];

    $classes = trim("{$baseClasses} {$variantClasses[$variant]} {$sizeClasses[$size]} {$class}");

    if ($disabled || $loading) {
        $classes .= ' opacity-50 cursor-not-allowed pointer-events-none';
    }

    $tag = $href ? 'a' : 'button';
    $iconSize = $iconSizeClasses[$size];
@endphp

<{{ $tag }}
    @if ($tag === 'button') type="{{ $type }}" @endif
    @if ($href) href="{{ $href }}" @endif
    @if ($disabled && $tag === 'button') disabled @endif
    @if ($loading) aria-busy="true" @endif
    class="{{ $classes }}"
    {{ $attributes->except(['class', 'variant', 'size', 'icon', 'iconPosition', 'loading', 'disabled', 'type', 'href']) }}
>
    @if ($loading)
        <svg class="animate-spin {{ $iconSize }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif ($icon && $iconPosition === 'left')
        <x-ui.icon :name="$icon" class="{{ $iconSize }}" />
    @endif

    @if (trim($slot) !== '')
        <span>{{ $slot }}</span>
    @endif

    @if ($icon && $iconPosition === 'right' && !$loading)
        <x-ui.icon :name="$icon" class="{{ $iconSize }}" />
    @endif
</{{ $tag }}>
