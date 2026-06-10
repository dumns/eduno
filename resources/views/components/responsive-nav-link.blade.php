@props(['active'])
@php
$classes = ($active ?? false)
    ? 'flex items-center px-4 py-2.5 rounded-ui-xl text-ui-sm font-medium text-primary bg-primary-light dark:bg-primary-dark/30 dark:text-primary-light transition-all duration-150'
    : 'flex items-center px-4 py-2.5 rounded-ui-xl text-ui-sm font-medium text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-150';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
