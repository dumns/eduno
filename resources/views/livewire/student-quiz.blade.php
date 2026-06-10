<div class="min-h-screen bg-surface dark:bg-background-dark py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-border dark:border-border-dark bg-gradient-to-r from-primary/5 to-primary-light/10 dark:from-primary-dark/10 dark:to-primary/5">
                <div class="flex items-center justify-between">
                    <div>
                        <x-ui.heading level="h2" size="lg" class="text-foreground dark:text-foreground-dark">
                            {{ $quiz->title }}
                        </x-ui.heading>
                        <x-ui.text size="sm" color="muted" class="mt-1">
                            {{ count($questions) }} questions
                        </x-ui.text>
                    </div>
                    @if(!$finished)
                        <div class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark rounded-ui-xl border border-border dark:border-border-dark">
                            <x-ui.icon name="clock" size="sm" class="text-warning" />
                            <span class="text-ui-sm font-semibold text-foreground dark:text-foreground-dark">
                                {{-- Timer --}}
                                <span x-data="{ 
                                    minutes: 0, 
                                    seconds: 0,
                                    totalSeconds: {{ count($questions) * 120 }},
                                    timerInterval: null,
                                    init() {
                                        this.timerInterval = setInterval(() => {
                                            if (this.totalSeconds <= 0) {
                                                clearInterval(this.timerInterval);
                                                $wire.call('finishQuiz');
                                                return;
                                            }
                                            this.totalSeconds--;
                                            this.minutes = Math.floor(this.totalSeconds / 60);
                                            this.seconds = this.totalSeconds % 60;
                                        }, 1000);
                                    },
                                    destroy() {
                                        clearInterval(this.timerInterval);
                                    }
                                }" x-init="init" x-cloak>
                                    <span x-text="String(minutes).padStart(2, '0')"></span>:<span x-text="String(seconds).padStart(2, '0')"></span>
                                </span>
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-6">
                @if ($finished)
                    {{-- Results --}}
                    <div class="text-center py-8">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-success/10 mb-6">
                            <x-ui.icon name="check-circle" size="2xl" class="text-success" />
                        </div>
                        <x-ui.heading level="h2" size="2xl" class="mb-2">Quiz Complete!</x-ui.heading>
                        <div class="flex items-center justify-center gap-8 mt-6 mb-8">
                            <div class="text-center">
                                <p class="text-ui-4xl font-bold text-success">{{ $score }}</p>
                                <p class="text-ui-sm text-muted dark:text-muted-dark">Correct</p>
                            </div>
                            <div class="w-px h-16 bg-border dark:bg-border-dark"></div>
                            <div class="text-center">
                                <p class="text-ui-4xl font-bold text-muted dark:text-muted-dark">{{ count($questions) }}</p>
                                <p class="text-ui-sm text-muted dark:text-muted-dark">Total</p>
                            </div>
                            <div class="w-px h-16 bg-border dark:bg-border-dark"></div>
                            <div class="text-center">
                                <p class="text-ui-4xl font-bold {{ ($score / count($questions)) * 100 >= 70 ? 'text-success' : (($score / count($questions)) * 100 >= 40 ? 'text-warning' : 'text-danger') }}">
                                    {{ round(($score / count($questions)) * 100) }}%
                                </p>
                                <p class="text-ui-sm text-muted dark:text-muted-dark">Score</p>
                            </div>
                        </div>
                        @php $pct = ($score / count($questions)) * 100; @endphp
                        <x-ui.card variant="flat" padding="sm" class="max-w-md mx-auto mb-6">
                            <div class="flex items-center gap-3">
                                <x-ui.icon 
                                    :name="$pct >= 70 ? 'check-badge' : ($pct >= 40 ? 'alert-triangle' : 'x-circle')" 
                                    size="lg" 
                                    :class="$pct >= 70 ? 'text-success' : ($pct >= 40 ? 'text-warning' : 'text-danger')" 
                                />
                                <x-ui.text size="sm" class="text-start">
                                    @if($pct >= 90)
                                        Outstanding! You've mastered this topic.
                                    @elseif($pct >= 70)
                                        Great job! You have a solid understanding.
                                    @elseif($pct >= 40)
                                        Keep practicing! Review the material and try again.
                                    @else
                                        Don't give up! Consider revisiting the course content.
                                    @endif
                                </x-ui.text>
                            </div>
                        </x-ui.card>
                        <div class="flex items-center justify-center gap-3">
                            <x-ui.button href="/" variant="outline" icon="home">Back to Home</x-ui.button>
                            @if($pct < 100)
                                <x-ui.button wire:click="resetQuiz" variant="ghost" icon="refresh">Try Again</x-ui.button>
                            @endif
                        </div>
                    </div>
                @else
                    @php $q = $questions[$current]; @endphp
                    {{-- Question Type Indicator --}}
                    @php $pct = 0; @endphp
                    {{-- Progress --}}
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <x-ui.text size="sm" color="muted">
                                Question {{ $current + 1 }} of {{ count($questions) }}
                            </x-ui.text>
                            <x-ui.badge variant="primary" size="xs">
                                {{ $q->type === 'multiple_choice' ? 'Multiple Choice' : 'Essay' }}
                            </x-ui.badge>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-primary h-2.5 rounded-full transition-all duration-500 ease-out"
                                style="width: {{ (($current + 1) / count($questions)) * 100 }}%"></div>
                        </div>
                    </div>

                    {{-- Question --}}
                    <div class="mb-6">
                        <div class="p-5 bg-primary-light/10 dark:bg-primary-dark/20 border border-primary/20 dark:border-primary-dark/30 rounded-ui-xl mb-6">
                            <x-ui.text size="base" weight="semibold" class="text-foreground dark:text-foreground-dark leading-relaxed">
                                {!! nl2br(e($q->question)) !!}
                            </x-ui.text>
                        </div>

                        @if ($q->type === 'multiple_choice')
                            <form wire:submit.prevent="answer({{ $q->id }})" class="space-y-3">
                                @foreach ($q->options as $opt)
                                    <label class="flex items-center p-4 bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl cursor-pointer hover:border-primary hover:bg-primary-light/5 dark:hover:bg-primary-dark/10 transition-all duration-150 group {{ isset($answers[$q->id]) && $answers[$q->id] == $opt->id ? 'border-primary bg-primary-light/10 dark:bg-primary-dark/20 ring-1 ring-primary' : '' }}">
                                        <input type="radio" name="answer" value="{{ $opt->id }}" wire:model.defer="answers.{{ $q->id }}" required
                                            class="h-4 w-4 border-border dark:border-border-dark text-primary focus:ring-primary transition-all duration-150">
                                        <span class="ml-3 text-ui-sm text-foreground dark:text-foreground-dark font-medium group-hover:text-primary transition-colors">
                                            {{ $opt->option }}
                                        </span>
                                    </label>
                                @endforeach
                                <x-ui.button type="submit" size="lg" class="w-full justify-center mt-4" icon="chevron-right" icon-position="right">
                                    Answer & Continue
                                </x-ui.button>
                            </form>
                        @elseif ($q->type === 'essay')
                            <form wire:submit.prevent="answer({{ $q->id }})" class="space-y-4">
                                <textarea
                                    wire:model.defer="answers.{{ $q->id }}"
                                    required
                                    placeholder="Type your answer here..."
                                    class="block w-full rounded-ui-xl border border-border dark:border-border-dark bg-white dark:bg-surface-dark text-foreground dark:text-foreground-dark placeholder-muted dark:placeholder-muted-dark px-4 py-3 text-ui-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-150 min-h-[120px]"
                                    rows="4"
                                ></textarea>
                                <x-ui.button type="submit" size="lg" class="w-full justify-center" icon="chevron-right" icon-position="right">
                                    Submit Answer & Continue
                                </x-ui.button>
                            </form>
                        @endif
                    </div>

                    {{-- Question Navigator --}}
                    <div class="pt-4 border-t border-border dark:border-border-dark">
                        <div class="flex items-center justify-between">
                            <x-ui.button wire:click="previousQuestion" variant="ghost" size="sm" icon="chevron-left" :disabled="$current === 0">
                                Previous
                            </x-ui.button>
                            <div class="flex items-center gap-1.5">
                                @foreach ($questions as $i => $question)
                                    <button wire:click="goToQuestion({{ $i }})" type="button"
                                        class="w-8 h-8 rounded-ui-lg text-ui-xs font-medium transition-all duration-150
                                         {{ $i === $current ? 'bg-primary text-white' : '' }}
                                        {{ isset($answers[$question->id]) ? 'bg-success/20 text-success' : '' }}
                                        {{ $i !== $current && !isset($answers[$question->id]) ? 'bg-gray-100 dark:bg-gray-800 text-muted dark:text-muted-dark hover:bg-gray-200 dark:hover:bg-gray-700' : '' }}">
                                        {{ $i + 1 }}
                                    </button>
                                @endforeach
                            </div>
                            <x-ui.button wire:click="nextQuestion" variant="ghost" size="sm" icon="chevron-right" icon-position="right" :disabled="$current === count($questions) - 1">
                                Next
                            </x-ui.button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
