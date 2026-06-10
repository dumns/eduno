@props([
    'name' => 'modal',
    'size' => 'md',
    'maxWidth' => null,
    'title' => null,
    'closeable' => true,
    'show' => false,
    'class' => '',
])

@php
    $sizeClasses = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        '2xl' => 'max-w-6xl',
        'full' => 'max-w-full mx-4',
    ];

    $maxWidthClasses = $maxWidth ? "max-w-[{$maxWidth}]" : $sizeClasses[$size];
@endphp

<div
    x-data="{
        show: @entangle($attributes->wire('model')->value() ?? 'show'),
        name: '{{ $name }}',
    }"
    x-init="
        $watch('show', value => { if(value) document.body.style.overflow = 'hidden'; else document.body.style.overflow = ''; });
        $el.closest('body') && $watch('show', value => { if(value) $el.closest('body').style.overflow = value ? 'hidden' : ''; });
    "
    x-on:open-modal.window="if ($event.detail === name) show = true"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="if(show && {{ $closeable ? 'true' : 'false' }}) show = false"
    x-show="show"
    class="fixed inset-0 z-[100] overflow-y-auto"
    style="display: none;"
    role="dialog"
    aria-modal="true"
    {{ $attributes->except(['class', 'name', 'size', 'maxWidth', 'title', 'closeable', 'show'])->whereDoesntStartWith('wire:') }}
>
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-10 text-center sm:p-0">
        <div x-show="show"
            x-transition:enter="transition-all duration-200 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-all duration-150 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
            @click="if({{ $closeable ? 'true' : 'false' }}) show = false"
            aria-hidden="true">
        </div>

        <div x-show="show"
            x-transition:enter="transition-all duration-200 ease-out"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition-all duration-150 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full {{ $maxWidthClasses }} bg-white dark:bg-surface-dark rounded-ui-2xl shadow-ui-2xl text-left align-middle"
            @click.outside="if({{ $closeable ? 'true' : 'false' }}) show = false">
            @if ($title || $closeable)
                <div class="flex items-center justify-between px-6 pt-6 pb-0">
                    @if ($title)
                        <x-ui.heading level="h3" size="lg">{{ $title }}</x-ui.heading>
                    @else
                        <div></div>
                    @endif
                    @if ($closeable)
                        <button type="button" @click="show = false" class="p-1.5 rounded-ui-lg text-muted dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                            <x-ui.icon name="close" size="sm" />
                        </button>
                    @endif
                </div>
            @endif

            @isset($header)
                <div class="px-6 pt-6 pb-0">{{ $header }}</div>
            @endisset

            <div class="px-6 py-5 {{ !$title && !$closeable && !isset($header) ? 'pt-6' : '' }}">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="flex items-center justify-end gap-3 px-6 pb-6 pt-0">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
