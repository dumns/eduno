@props(['name', 'show' => false, 'maxWidth' => '2xl'])
@php
$maxWidth = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
][$maxWidth];
@endphp
<x-ui.modal :name="$name" :show="$show" :max-width="$maxWidth">
    {{ $slot }}
</x-ui.modal>
