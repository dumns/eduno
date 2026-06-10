@props([
    'label' => null,
    'name' => null,
    'error' => null,
    'hint' => null,
    'required' => false,
    'class' => '',
])

<div class="{{ $class }}" {{ $attributes->except(['class', 'label', 'name', 'error', 'hint', 'required']) }}>
    @if ($label)
        <x-ui.label :for="$name" :required="$required">{{ $label }}</x-ui.label>
    @endif

    {{ $slot }}

    @if ($error)
        <x-ui.form-error>{{ $error }}</x-ui.form-error>
    @endif

    @if ($hint && !$error)
        <p class="mt-1.5 text-ui-xs text-muted dark:text-muted-dark">{{ $hint }}</p>
    @endif
</div>
