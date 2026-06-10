@props([
    'class' => '',
])

<p class="mt-1.5 text-ui-sm text-danger flex items-center gap-1 {{ $class }}"
    {{ $attributes->except(['class']) }}>
    <x-ui.icon name="alert-circle" size="xs" />
    {{ $slot }}
</p>
