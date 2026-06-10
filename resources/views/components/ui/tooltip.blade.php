@props([
    'text' => '',
    'position' => 'top',
    'class' => '',
])

@php
    $positionClasses = [
        'top' => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
        'bottom' => 'top-full left-1/2 -translate-x-1/2 mt-2',
        'left' => 'right-full top-1/2 -translate-y-1/2 mr-2',
        'right' => 'left-full top-1/2 -translate-y-1/2 ml-2',
    ];

    $arrowClasses = [
        'top' => 'top-full left-1/2 -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-gray-900 dark:border-t-gray-700',
        'bottom' => 'bottom-full left-1/2 -translate-x-1/2 border-l-4 border-r-4 border-b-4 border-l-transparent border-r-transparent border-b-gray-900 dark:border-b-gray-700',
        'left' => 'left-full top-1/2 -translate-y-1/2 border-t-4 border-b-4 border-l-4 border-t-transparent border-b-transparent border-l-gray-900 dark:border-l-gray-700',
        'right' => 'right-full top-1/2 -translate-y-1/2 border-t-4 border-b-4 border-r-4 border-t-transparent border-b-transparent border-r-gray-900 dark:border-r-gray-700',
    ];
@endphp

<div class="relative inline-flex group {{ $class }}">
    {{ $slot }}
    <div class="absolute z-50 {{ $positionClasses[$position] }} hidden group-hover:block pointer-events-none">
        <div class="relative px-2 py-1 text-ui-xs font-medium text-white bg-gray-900 dark:bg-gray-700 rounded-ui-md shadow-sm whitespace-nowrap">
            {{ $text }}
            <div class="absolute {{ $arrowClasses[$position] }}"></div>
        </div>
    </div>
</div>
