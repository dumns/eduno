<div class="min-h-screen bg-surface dark:bg-background-dark">
    {{-- Hero --}}
    <div class="bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="max-w-3xl">
                <x-ui.badge variant="primary" size="sm" dot class="mb-4">New courses added weekly</x-ui.badge>
                <x-ui.heading level="h1" size="4xl" class="mb-4">
                    Start Your Web Development Journey
                </x-ui.heading>
                <x-ui.text size="lg" color="muted" class="max-w-2xl">
                    Dive into our library of courses designed for all skill levels, focusing on Laravel, Livewire, and Filament.
                </x-ui.text>
                <div class="flex items-center gap-4 mt-8">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-primary/20 border-2 border-white dark:border-surface-dark flex items-center justify-center text-ui-xs font-semibold text-primary">JD</div>
                        <div class="w-8 h-8 rounded-full bg-success/20 border-2 border-white dark:border-surface-dark flex items-center justify-center text-ui-xs font-semibold text-success">AK</div>
                        <div class="w-8 h-8 rounded-full bg-warning/20 border-2 border-white dark:border-surface-dark flex items-center justify-center text-ui-xs font-semibold text-warning">MS</div>
                        <div class="w-8 h-8 rounded-full bg-info/20 border-2 border-white dark:border-surface-dark flex items-center justify-center text-ui-xs font-semibold text-info">+2</div>
                    </div>
                    <x-ui.text size="sm" color="muted">Join <span class="font-semibold text-foreground dark:text-foreground-dark">2,500+</span> students</x-ui.text>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filters --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
            <div class="relative flex-1 max-w-md w-full">
                <x-ui.icon name="search" size="sm" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted dark:text-muted-dark pointer-events-none" />
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search courses..." 
                    class="block w-full pl-10 pr-3 py-2.5 text-ui-sm bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl placeholder-muted dark:placeholder-muted-dark text-foreground dark:text-foreground-dark focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition-all duration-150">
            </div>

            @if($allTags->count() > 0)
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-ui-xs text-muted dark:text-muted-dark font-medium">Filter:</span>
                    @foreach($allTags as $tag)
                        <button wire:click="toggleTag({{ $tag->id }})" type="button"
                            class="px-3 py-1.5 rounded-ui-lg text-ui-xs font-medium transition-all duration-150
                            {{ in_array($tag->id, $selectedTags) 
                                ? 'bg-primary text-white' 
                                : 'bg-gray-100 dark:bg-gray-800 text-muted dark:text-muted-dark hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                            {{ $tag->name }}
                        </button>
                    @endforeach
                    @if(!empty($selectedTags))
                        <button wire:click="$set('selectedTags', [])" type="button" class="text-ui-xs text-muted dark:text-muted-dark hover:text-danger underline ml-1">
                            Clear
                        </button>
                    @endif
                </div>
            @endif
        </div>

        {{-- Course Grid --}}
        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($courses as $course)
                    <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden transition-all duration-200 hover:ring-1 hover:ring-primary/30 hover:border-primary/30 flex flex-col">
                        {{-- Banner --}}
                        <div class="h-28 bg-gradient-to-br from-primary/10 to-primary-light/20 dark:from-primary-dark/30 dark:to-primary/10 flex items-center justify-center">
                            <i class="za-book-simple-duotone w-10 h-10 text-primary/30 dark:text-primary-light/20"></i>
                        </div>

                        {{-- Content --}}
                        <div class="p-4 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                @foreach($course->tags as $tag)
                                    <x-ui.badge variant="primary" size="xs">{{ $tag->name }}</x-ui.badge>
                                @endforeach
                            </div>
                            <x-ui.heading level="h3" size="base" weight="semibold" class="mb-1">{{ $course->title }}</x-ui.heading>
                            @if($course->tagline)
                                <x-ui.text size="sm" color="muted" class="mb-3 line-clamp-2">{{ $course->tagline }}</x-ui.text>
                            @endif
                            <div class="mt-auto flex items-center gap-3 text-ui-xs text-muted dark:text-muted-dark pt-3 border-t border-border dark:border-border-dark">
                                <span class="flex items-center gap-1">
                                    <x-ui.icon name="book" size="xs" />
                                    {{ $course->episodes_count }} {{ Str::plural('episode', $course->episodes_count) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <x-ui.icon name="clock" size="xs" />
                                    {{ $course->formatted_length }}
                                </span>
                            </div>
                            <x-ui.button href="{{ route('courses.show', $course) }}" variant="ghost" size="sm" icon="chevron-right" icon-position="right" class="w-full justify-center mt-3">
                                Start Watching
                            </x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                    <x-ui.icon name="book" size="xl" class="text-muted dark:text-muted-dark" />
                </div>
                <x-ui.heading level="h3" size="lg" class="mb-2">No courses found</x-ui.heading>
                <x-ui.text size="sm" color="muted">Try adjusting your search or filter criteria.</x-ui.text>
            </div>
        @endif
    </div>
</div>
