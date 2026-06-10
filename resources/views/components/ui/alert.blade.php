@props([
    'type' => 'info',
    'dismissible' => false,
    'icon' => true,
    'title' => null,
    'class' => '',
])

@php
    $config = [
        'success' => [
            'bg' => 'bg-success-light dark:bg-success/20',
            'border' => 'border-success/30 dark:border-success/30',
            'text' => 'text-success-hover dark:text-success-light',
            'icon' => 'check-circle',
        ],
        'danger' => [
            'bg' => 'bg-danger-light dark:bg-danger/20',
            'border' => 'border-danger/30 dark:border-danger/30',
            'text' => 'text-danger-hover dark:text-danger-light',
            'icon' => 'x-circle',
        ],
        'warning' => [
            'bg' => 'bg-warning-light dark:bg-warning/20',
            'border' => 'border-warning/30 dark:border-warning/30',
            'text' => 'text-warning-hover dark:text-warning-light',
            'icon' => 'alert-triangle',
        ],
        'info' => [
            'bg' => 'bg-info-light dark:bg-info/20',
            'border' => 'border-info/30 dark:border-info/30',
            'text' => 'text-info-hover dark:text-info-light',
            'icon' => 'info',
        ],
        'primary' => [
            'bg' => 'bg-primary-light dark:bg-primary/20',
            'border' => 'border-primary/30 dark:border-primary/30',
            'text' => 'text-primary-dark dark:text-primary-light',
            'icon' => 'check-badge',
        ],
    ];

    $alert = $config[$type];
    $classes = "relative flex items-start gap-3 p-4 rounded-ui-xl border {$alert['bg']} {$alert['border']} {$class}";
@endphp

<div role="alert" class="{{ $classes }}"
    @if ($dismissible)
        x-data="{ show: true }" x-show="show"
    @endif
    {{ $attributes->except(['class', 'type', 'dismissible', 'icon', 'title']) }}>
    @if ($icon)
        <x-ui.icon :name="$alert['icon']" size="md" class="{{ $alert['text'] }} mt-0.5 flex-shrink-0" />
    @endif

    <div class="flex-1 min-w-0">
        @if ($title)
            <p class="text-ui-sm font-semibold {{ $alert['text'] }} mb-1">{{ $title }}</p>
        @endif
        <div class="text-ui-sm {{ $alert['text'] }} opacity-90">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button type="button" @click="show = false" class="flex-shrink-0 p-1 rounded-lg {{ $alert['text'] }} hover:opacity-75 transition-opacity focus:outline-none focus:ring-2 focus:ring-current">
            <x-ui.icon name="close" size="sm" />
        </button>
    @endif
</div>
