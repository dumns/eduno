@props([
    'title' => null,
    'value' => null,
    'icon' => null,
    'trend' => null,
    'trendType' => 'up',
    'variant' => 'primary',
    'class' => '',
])

@php
    $variantClasses = [
        'primary' => 'bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary-light',
        'secondary' => 'bg-secondary/10 dark:bg-secondary/20 text-secondary',
        'success' => 'bg-success/10 dark:bg-success/20 text-success',
        'danger' => 'bg-danger/10 dark:bg-danger/20 text-danger',
        'warning' => 'bg-warning/10 dark:bg-warning/20 text-warning',
        'info' => 'bg-info/10 dark:bg-info/20 text-info',
    ];
@endphp

<div class="relative p-5 sm:p-6 bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-800/50 {{ $class }}"
    {{ $attributes->except(['class', 'title', 'value', 'icon', 'trend', 'trendType', 'variant']) }}>
    <div class="flex items-start justify-between">
        <div class="flex-1 min-w-0">
            @if ($title)
                <p class="text-ui-sm font-medium text-muted dark:text-muted-dark truncate">{{ $title }}</p>
            @endif
            @if ($value)
                <p class="mt-1 text-ui-2xl font-bold text-foreground dark:text-foreground-dark tracking-tight">{{ $value }}</p>
            @endif
            @if ($trend)
                <div class="mt-2 flex items-center gap-1">
                    <x-ui.icon 
                        :name="$trendType === 'up' ? 'chevron-up' : 'chevron-down'" 
                        size="xs" 
                        class="{{ $trendType === 'up' ? 'text-success' : 'text-danger' }}" 
                    />
                    <span class="text-ui-xs font-medium {{ $trendType === 'up' ? 'text-success' : 'text-danger' }}">
                        {{ $trend }}
                    </span>
                </div>
            @endif
        </div>
        @if ($icon)
            <div class="flex-shrink-0 p-3 rounded-ui-xl {{ $variantClasses[$variant] }}">
                <x-ui.icon :name="$icon" size="lg" />
            </div>
        @endif
    </div>
</div>
