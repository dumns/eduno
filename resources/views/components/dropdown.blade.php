@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])
<x-ui.dropdown {{ $attributes->merge(['align' => $align, 'width' => $width]) }}>
    <x-slot name="trigger">
        {{ $trigger }}
    </x-slot>
    {{ $content }}
</x-ui.dropdown>
