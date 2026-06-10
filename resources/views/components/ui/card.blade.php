@props([
    'variant' => 'default',
    'padding' => 'md',
    'class' => '',
])

@php
    $variantClasses = [
        'default' => 'bg-white dark:bg-surface-dark border border-border dark:border-border-dark shadow-sm',
        'elevated' => 'bg-white dark:bg-surface-dark shadow-ui-lg border border-border dark:border-border-dark',
        'outlined' => 'bg-transparent border-2 border-border dark:border-border-dark',
        'flat' => 'bg-surface dark:bg-surface-dark border-none',
        'ghost' => 'bg-transparent border-none shadow-none',
    ];

    $paddingClasses = [
        'none' => '',
        'xs' => 'p-3',
        'sm' => 'p-4',
        'md' => 'p-5 sm:p-6',
        'lg' => 'p-6 sm:p-8',
        'xl' => 'p-8 sm:p-10',
    ];
@endphp

<div class="rounded-ui-2xl {{ $variantClasses[$variant] }} {{ $paddingClasses[$padding] }} {{ $class }}"
    {{ $attributes->except(['class', 'variant', 'padding']) }}>
    @isset($header)
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-border dark:border-border-dark">
            {{ $header }}
        </div>
    @endisset

    {{ $slot }}

    @isset($footer)
        <div class="pt-4 mt-4 border-t border-border dark:border-border-dark flex items-center justify-between">
            {{ $footer }}
        </div>
    @endisset
</div>
