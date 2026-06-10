@props([
    'for' => null,
    'required' => false,
    'class' => '',
])

<label for="{{ $for }}"
    class="block text-ui-sm font-medium text-foreground dark:text-foreground-dark mb-1.5 {{ $class }}"
    {{ $attributes->except(['class', 'for', 'required']) }}>
    {{ $slot }}
    @if ($required)
        <span class="text-danger ml-0.5">*</span>
    @endif
</label>
