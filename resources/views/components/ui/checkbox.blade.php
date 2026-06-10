@props([
    'name' => null,
    'id' => null,
    'value' => '1',
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'model' => null,
    'class' => '',
])

@php
    $inputId = $id ?? $name ?? 'checkbox-' . str()->random(8);
@endphp

<label for="{{ $inputId }}" class="inline-flex items-center gap-2.5 cursor-pointer group {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }} {{ $class }}"
    {{ $attributes->except(['class', 'name', 'id', 'value', 'label', 'checked', 'disabled', 'model']) }}>
    <input
        type="checkbox"
        id="{{ $inputId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if ($checked) checked @endif
        @if ($disabled) disabled @endif
        @if ($model) wire:model="{{ $model }}" @endif
        class="h-4 w-4 rounded border-border dark:border-border-dark bg-white dark:bg-surface-dark text-primary focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-surface-dark transition-all duration-150 cursor-pointer disabled:cursor-not-allowed"
    />
    @if ($label)
        <span class="text-ui-sm text-foreground dark:text-foreground-dark select-none group-hover:text-foreground/80 dark:group-hover:text-foreground-dark/80 transition-colors duration-150">{{ $label }}</span>
    @endif
</label>
