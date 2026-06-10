@props([
    'type' => 'text',
    'label' => null,
    'name' => null,
    'id' => null,
    'value' => null,
    'placeholder' => null,
    'error' => null,
    'hint' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'prefix' => null,
    'suffix' => null,
    'model' => null,
    'class' => '',
])

@php
    $inputId = $id ?? $name ?? 'input-' . str()->random(8);
    $baseClasses = 'block w-full rounded-ui-lg border bg-white dark:bg-surface-dark text-foreground dark:text-foreground-dark placeholder-muted dark:placeholder-muted-dark shadow-sm transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary dark:focus:border-primary disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 dark:disabled:bg-gray-800/50 readonly:opacity-80';

    $sizeClasses = 'px-3 py-2.5 text-ui-sm';
    $errorClasses = $error ? 'border-danger focus:ring-danger focus:border-danger' : 'border-border dark:border-border-dark hover:border-gray-300 dark:hover:border-gray-600';
    $withPrefix = $prefix ? 'pl-10' : '';
    $withSuffix = $suffix ? 'pr-10' : '';
@endphp

<div class="w-full {{ $class }}">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-ui-sm font-medium text-foreground dark:text-foreground-dark mb-1.5">
            {{ $label }}
            @if ($required)
                <span class="text-danger ml-0.5">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if ($prefix)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-muted dark:text-muted-dark">
                {{ $prefix }}
            </div>
        @endif

        @if ($type === 'textarea')
            <textarea
                id="{{ $inputId }}"
                name="{{ $name }}"
                rows="3"
                @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif
                @if ($required) required @endif
                @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                @if ($model) wire:model="{{ $model }}" @endif
                class="{{ $baseClasses }} {{ $errorClasses }} {{ $withPrefix }} {{ $withSuffix }}"
                {{ $attributes->except(['class', 'type', 'label', 'name', 'id', 'value', 'placeholder', 'error', 'hint', 'disabled', 'readonly', 'required', 'prefix', 'suffix', 'model']) }}
            >{{ $value }}</textarea>
        @else
            <input
                type="{{ $type }}"
                id="{{ $inputId }}"
                name="{{ $name }}"
                value="{{ $value }}"
                @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif
                @if ($required) required @endif
                @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                @if ($model) wire:model="{{ $model }}" @endif
                class="{{ $baseClasses }} {{ $errorClasses }} {{ $withPrefix }} {{ $withSuffix }}"
                {{ $attributes->except(['class', 'type', 'label', 'name', 'id', 'value', 'placeholder', 'error', 'hint', 'disabled', 'readonly', 'required', 'prefix', 'suffix', 'model']) }}
            />
        @endif

        @if ($suffix)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-muted dark:text-muted-dark">
                {{ $suffix }}
            </div>
        @endif
    </div>

    @if ($error)
        <p class="mt-1.5 text-ui-sm text-danger">{{ $error }}</p>
    @endif

    @if ($hint && !$error)
        <p class="mt-1.5 text-ui-xs text-muted dark:text-muted-dark">{{ $hint }}</p>
    @endif
</div>
