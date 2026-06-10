@props([
    'sortable' => false,
    'field' => null,
    'sortField' => null,
    'sortDirection' => null,
    'align' => 'left',
    'class' => '',
    'type' => 'header',
])

@php
    $alignClasses = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];

    $headerClasses = 'px-4 py-3.5 text-ui-xs font-semibold uppercase tracking-wider text-muted dark:text-muted-dark ' . $alignClasses[$align];
    $cellClasses = 'px-4 py-4 text-ui-sm text-foreground dark:text-foreground-dark whitespace-nowrap ' . $alignClasses[$align];
@endphp

@if ($type === 'header' && $sortable)
    <th scope="col" class="{{ $headerClasses }} {{ $class }}" {{ $attributes->except(['class', 'sortable', 'field', 'sortField', 'sortDirection', 'align', 'type']) }}>
        <button type="button" wire:click="sortBy('{{ $field }}')" class="group inline-flex items-center gap-1.5 text-current hover:text-foreground dark:hover:text-foreground-dark transition-colors duration-150">
            <span>{{ $slot }}</span>
            <span class="flex flex-col -space-y-1">
                <x-ui.icon name="chevron-up" size="xs" class="{{ $sortField === $field && $sortDirection === 'asc' ? 'text-primary' : 'text-muted/40 dark:text-muted-dark/40' }}" />
                <x-ui.icon name="chevron-down" size="xs" class="{{ $sortField === $field && $sortDirection === 'desc' ? 'text-primary' : 'text-muted/40 dark:text-muted-dark/40' }}" />
            </span>
        </button>
    </th>
@elseif ($type === 'header')
    <th scope="col" class="{{ $headerClasses }} {{ $class }}" {{ $attributes->except(['class', 'sortable', 'field', 'sortField', 'sortDirection', 'align', 'type']) }}>
        {{ $slot }}
    </th>
@else
    <td class="{{ $cellClasses }} {{ $class }}" {{ $attributes->except(['class', 'sortable', 'field', 'sortField', 'sortDirection', 'align', 'type']) }}>
        {{ $slot }}
    </td>
@endif
