@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'disabled' => false,
    'model' => null,
    'class' => '',
    'value' => '1',
])

@php
    $inputId = $id ?? $name ?? 'switch-' . str()->random(8);
@endphp

<label for="{{ $inputId }}"
    class="relative inline-flex items-start gap-3 cursor-pointer group {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }} {{ $class }}"
    {{ $attributes->except(['class', 'name', 'id', 'label', 'description', 'checked', 'disabled', 'model', 'value']) }}>
    <input
        type="checkbox"
        id="{{ $inputId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        role="switch"
        @if ($checked) checked @endif
        @if ($disabled) disabled @endif
        @if ($model) wire:model="{{ $model }}" @endif
        class="sr-only peer"
    />
    <div class="relative inline-flex h-5 w-9 flex-shrink-0 rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 transition-colors duration-200 ease-in-out peer-checked:bg-primary peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary peer-focus:ring-offset-2 dark:peer-focus:ring-offset-surface-dark after:absolute after:top-0.5 after:left-0.5 after:h-4 after:w-4 after:rounded-full after:bg-white after:shadow-sm after:transition-all after:duration-200 peer-checked:after:translate-x-full"></div>
    @if ($label || $description)
        <div class="flex flex-col">
            @if ($label)
                <span class="text-ui-sm font-medium text-foreground dark:text-foreground-dark select-none">{{ $label }}</span>
            @endif
            @if ($description)
                <span class="text-ui-xs text-muted dark:text-muted-dark mt-0.5">{{ $description }}</span>
            @endif
        </div>
    @endif
</label>
