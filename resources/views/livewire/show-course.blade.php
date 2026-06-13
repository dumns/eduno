<div class="min-h-screen bg-surface dark:bg-background-dark">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Back --}}
        <a href="{{ route('courses') }}" wire:navigate class="inline-flex items-center gap-1.5 text-ui-sm text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark transition-colors mb-6">
            <x-ui.icon name="chevron-left" size="sm" />
            Back to Courses
        </a>

        {{-- Hero --}}
        <div class="bg-gradient-to-br from-primary/5 to-primary-light/10 dark:from-primary-dark/10 dark:to-primary/5 rounded-ui-2xl p-6 sm:p-8 mb-6">
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($course->tags as $tag)
                    <x-ui.badge variant="primary" size="sm">{{ $tag->name }}</x-ui.badge>
                @endforeach
            </div>
            <x-ui.heading level="h1" size="4xl" class="mb-3">{{ $course->title }}</x-ui.heading>
            @if($course->tagline)
                <x-ui.text size="lg" color="muted" class="max-w-2xl">{{ $course->tagline }}</x-ui.text>
            @endif
        </div>

        {{-- TODO: unhide when episodes/data available --}}
        {{-- Stats
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl p-5 text-center">
                <x-ui.icon name="book" size="lg" class="text-primary mx-auto mb-2" />
                <p class="text-ui-2xl font-bold text-foreground dark:text-foreground-dark">{{ $course->episodes_count }}</p>
                <p class="text-ui-sm text-muted dark:text-muted-dark">Episodes</p>
            </div>
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl p-5 text-center">
                <x-ui.icon name="clock" size="lg" class="text-success mx-auto mb-2" />
                <p class="text-ui-2xl font-bold text-foreground dark:text-foreground-dark">{{ $course->formatted_length }}</p>
                <p class="text-ui-sm text-muted dark:text-muted-dark">Duration</p>
            </div>
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl p-5 text-center">
                <x-ui.icon name="calendar" size="lg" class="text-info mx-auto mb-2" />
                <p class="text-ui-2xl font-bold text-foreground dark:text-foreground-dark">{{ $course->created_at->diffForHumans() }}</p>
                <p class="text-ui-sm text-muted dark:text-muted-dark">Published</p>
            </div>
        </div>
        --}}

        {{-- TODO: unhide when description is filled --}}
        {{-- About
        @if($course->description)
            <x-ui.card variant="default" padding="lg" class="mb-6">
                <x-slot:header>
                    <div class="flex items-center gap-2">
                        <x-ui.icon name="info" size="sm" class="text-primary" />
                        <x-ui.heading level="h3" size="lg">About this course</x-ui.heading>
                    </div>
                </x-slot:header>
                <div class="prose prose-sm dark:prose-invert max-w-none text-foreground dark:text-foreground-dark leading-relaxed">
                    {{ $course->description }}
                </div>
            </x-ui.card>
        @endif
        --}}

        {{-- TODO: unhide when episodes available --}}
        {{-- CTA
        <div class="mb-6">
            <x-ui.button
                href="{{ route('courses.episodes.show', ['course' => $course]) }}"
                size="lg"
                icon="play"
                icon-position="right"
                class="w-full justify-center"
            >
                {{ auth()->user()?->courses->contains($course) ? 'Continue Watching' : 'Start Watching' }}
            </x-ui.button>
        </div>
        --}}

        {{-- TODO: unhide when episodes available --}}
        {{-- Episodes
        <x-ui.card variant="default" padding="none" class="mb-6 overflow-hidden">
            <x-slot:header>
                <div class="flex items-center gap-2 px-6 pt-6 pb-0">
                    <x-ui.icon name="book" size="sm" class="text-primary" />
                    <x-ui.heading level="h3" size="lg">Course Episodes</x-ui.heading>
                    <x-ui.badge variant="neutral" size="xs" class="ml-auto">{{ $course->episodes_count }} episodes</x-ui.badge>
                </div>
            </x-slot:header>
            <div class="divide-y divide-border dark:divide-border-dark">
                @forelse($course->episodes as $episode)
                    <a href="{{ route('courses.episodes.show', ['course' => $course, 'episode' => $episode]) }}"
                       class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                        <div class="flex-shrink-0 w-9 h-9 rounded-ui-xl bg-primary/10 dark:bg-primary-dark/30 flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <x-ui.icon name="play" size="sm" class="text-primary" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-ui-sm font-medium text-foreground dark:text-foreground-dark truncate">{{ $episode->title }}</p>
                        </div>
                        <div class="flex items-center gap-1.5 text-ui-xs text-muted dark:text-muted-dark flex-shrink-0">
                            <x-ui.icon name="clock" size="xs" />
                            {{ $episode->formatted_length }}
                        </div>
                        <x-ui.icon name="chevron-right" size="sm" class="text-muted dark:text-muted-dark group-hover:text-primary transition-colors flex-shrink-0" />
                    </a>
                @empty
                    <div class="px-6 py-8 text-center">
                        <x-ui.text size="sm" color="muted">No episodes available yet.</x-ui.text>
                    </div>
                @endforelse
            </div>
        </x-ui.card>
        --}}

        {{-- TODO: unhide when quizzes available --}}
        {{-- Quizzes
        @if($course->quizzes->count() > 0)
            <x-ui.card variant="default" padding="none" class="mb-6 overflow-hidden">
                <x-slot:header>
                    <div class="flex items-center gap-2 px-6 pt-6 pb-0">
                        <x-ui.icon name="check-circle" size="sm" class="text-warning" />
                        <x-ui.heading level="h3" size="lg">Course Quizzes</x-ui.heading>
                        <x-ui.badge variant="neutral" size="xs" class="ml-auto">{{ $course->quizzes->count() }} quizzes</x-ui.badge>
                    </div>
                </x-slot:header>
                <div class="divide-y divide-border dark:divide-border-dark">
                    @foreach($course->quizzes as $quiz)
                        <a href="{{ route('quiz.student', ['quiz' => $quiz]) }}"
                           class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                            <div class="flex-shrink-0 w-9 h-9 rounded-ui-xl bg-warning/10 dark:bg-warning/20 flex items-center justify-center group-hover:bg-warning/20 transition-colors">
                                <x-ui.icon name="check-circle" size="sm" class="text-warning" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-ui-sm font-medium text-foreground dark:text-foreground-dark truncate">{{ $quiz->title }}</p>
                            </div>
                            <div class="flex items-center gap-1.5 text-ui-xs text-muted dark:text-muted-dark flex-shrink-0">
                                <x-ui.icon name="list-bullet" size="xs" />
                                {{ $quiz->questions_count }} questions
                            </div>
                            <x-ui.icon name="chevron-right" size="sm" class="text-muted dark:text-muted-dark group-hover:text-primary transition-colors flex-shrink-0" />
                        </a>
                    @endforeach
                </div>
            </x-ui.card>
        @endif
        --}}
    </div>
</div>
