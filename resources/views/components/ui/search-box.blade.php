@props([
    'name' => 'search',
    'placeholder' => 'Search...',
    'model' => null,
    'value' => null,
    'class' => '',
])

<div class="relative {{ $class }}" {{ $attributes->except(['class', 'name', 'placeholder', 'model', 'value']) }}>
    <x-ui.icon name="search" size="sm" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted dark:text-muted-dark pointer-events-none" />
    <input
        type="text"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if ($model) wire:model.live.debounce.300ms="{{ $model }}" @endif
        class="block w-full pl-10 pr-3 py-2.5 text-ui-sm bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-lg placeholder-muted dark:placeholder-muted-dark text-foreground dark:text-foreground-dark shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:focus:border-primary transition-all duration-150"
    />
</div>
