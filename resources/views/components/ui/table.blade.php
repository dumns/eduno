@props([
    'class' => '',
    'striped' => false,
    'hover' => true,
    'compact' => false,
    'responsive' => true,
])

@php
    $wrapperClasses = $responsive ? 'overflow-x-auto -mx-4 sm:mx-0 rounded-ui-2xl' : '';
@endphp

<div class="{{ $wrapperClasses }} {{ $class }}"
    {{ $attributes->except(['class', 'striped', 'hover', 'compact', 'responsive']) }}>
    <table class="min-w-full divide-y divide-border dark:divide-border-dark">
        @isset($header)
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    {{ $header }}
                </tr>
            </thead>
        @endisset

        <tbody class="bg-white dark:bg-surface-dark divide-y divide-border dark:divide-border-dark">
            {{ $slot }}
        </tbody>

        @isset($footer)
            <tfoot class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    {{ $footer }}
                </tr>
            </tfoot>
        @endisset
    </table>
</div>
