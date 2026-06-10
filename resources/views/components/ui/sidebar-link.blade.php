@props([
    'href' => null,
    'icon' => null,
    'active' => false,
    'badge' => null,
    'class' => '',
])

@php
    $baseClasses = 'flex items-center gap-3 px-3 py-2.5 text-ui-sm font-medium rounded-ui-xl transition-all duration-150';

    $activeClasses = $active
        ? 'bg-primary-light dark:bg-primary-dark/30 text-primary-dark dark:text-primary-light'
        : 'text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-foreground dark:hover:text-foreground-dark';
@endphp

@if ($href)
    <a href="{{ $href }}"
        class="{{ $baseClasses }} {{ $activeClasses }} {{ $class }}"
        {{ $attributes->except(['class', 'href', 'icon', 'active', 'badge']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="flex-shrink-0 {{ $active ? 'text-primary dark:text-primary-light' : 'text-muted dark:text-muted-dark' }}" />
        @endif
        <span class="flex-1 truncate">{{ $slot }}</span>
        @if ($badge)
            <x-ui.badge size="xs" variant="{{ $active ? 'primary' : 'neutral' }}">{{ $badge }}</x-ui.badge>
        @endif
    </a>
@else
    <button type="button"
        class="{{ $baseClasses }} {{ $activeClasses }} {{ $class }} w-full text-left"
        {{ $attributes->except(['class', 'href', 'icon', 'active', 'badge']) }}>
        @if ($icon)
            <x-ui.icon :name="$icon" size="sm" class="flex-shrink-0 {{ $active ? 'text-primary dark:text-primary-light' : 'text-muted dark:text-muted-dark' }}" />
        @endif
        <span class="flex-1 truncate">{{ $slot }}</span>
        @if ($badge)
            <x-ui.badge size="xs" variant="{{ $active ? 'primary' : 'neutral' }}">{{ $badge }}</x-ui.badge>
        @endif
    </button>
@endif
