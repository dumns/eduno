@props([
    'title' => 'Dashboard',
    'subtitle' => null,
    'class' => '',
])

<div class="{{ $class }}" {{ $attributes->except(['class', 'title', 'subtitle']) }}>
    <div class="mb-6 sm:mb-8">
        <x-ui.heading level="h1" size="xl">{{ $title }}</x-ui.heading>
        @if ($subtitle)
            <x-ui.text size="sm" color="muted" class="mt-1">{{ $subtitle }}</x-ui.text>
        @endif
    </div>

    {{ $slot }}
</div>
