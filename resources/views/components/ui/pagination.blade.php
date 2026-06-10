@props([
    'paginator' => null,
    'class' => '',
])

@if ($paginator && $paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between {{ $class }}" {{ $attributes->except(['class', 'paginator']) }}>
        <div class="flex-1 flex items-center gap-2">
            <p class="text-ui-sm text-muted dark:text-muted-dark">
                Showing
                <span class="font-medium text-foreground dark:text-foreground-dark">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium text-foreground dark:text-foreground-dark">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium text-foreground dark:text-foreground-dark">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg text-muted dark:text-muted-dark bg-transparent cursor-not-allowed">
                    <x-ui.icon name="chevron-left" size="sm" />
                </span>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                    <x-ui.icon name="chevron-left" size="sm" />
                </button>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg bg-primary text-white text-ui-sm font-semibold">{{ $page }}</span>
                @else
                    <button type="button" wire:click="gotoPage({{ $page }})" class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary text-ui-sm transition-all duration-150">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                    <x-ui.icon name="chevron-right" size="sm" />
                </button>
            @else
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-ui-lg text-muted dark:text-muted-dark bg-transparent cursor-not-allowed">
                    <x-ui.icon name="chevron-right" size="sm" />
                </span>
            @endif
        </div>
    </nav>
@endif
