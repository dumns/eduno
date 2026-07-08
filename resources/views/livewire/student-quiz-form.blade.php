<div class="min-h-screen bg-surface dark:bg-background-dark py-8 px-4">
    <div class="max-w-3xl mx-auto">
        @if($submitted)
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl p-8 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-success/10 mb-5">
                    <x-ui.icon name="check-circle" size="2xl" class="text-success" />
                </div>
                <x-ui.heading level="h2" size="xl" class="mb-2">Quiz Submitted Successfully</x-ui.heading>
                <x-ui.text size="base" color="muted" class="mb-6">
                    Your answers have been saved. Thank you for completing this quiz.
                </x-ui.text>

                @if($quiz->show_result && $result)
                    <div class="flex items-center justify-center gap-6 mb-6 py-4 px-6 bg-surface dark:bg-background-dark rounded-ui-xl border border-border dark:border-border-dark">
                        <div>
                            <x-ui.text size="xs" color="muted" class="mb-1">Skor</x-ui.text>
                            <x-ui.heading level="h3" size="lg">{{ $result['score'] }} / {{ $result['max_score'] }}</x-ui.heading>
                        </div>
                        <div class="w-px h-10 bg-border dark:bg-border-dark"></div>
                        <div>
                            <x-ui.text size="xs" color="muted" class="mb-1">Persentase</x-ui.text>
                            <x-ui.heading level="h3" size="lg" class="text-primary">{{ number_format($result['percentage'], 1) }}%</x-ui.heading>
                        </div>
                    </div>
                @endif

                <x-ui.button href="{{ route('courses.show', $quiz->course) }}" variant="primary" icon="chevron-left" class="justify-center">
                    Back to Course
                </x-ui.button>
            </div>
        @else
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden">
                {{-- Header --}}
                <div class="px-6 py-5 border-b border-border dark:border-border-dark bg-gradient-to-r from-primary/5 to-primary-light/10 dark:from-primary-dark/10 dark:to-primary/5">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-ui.heading level="h2" size="lg">
                                {{ $quiz->title }}
                            </x-ui.heading>
                            <x-ui.text size="sm" color="muted" class="mt-1">
                                {{ count($questions) }} questions
                            </x-ui.text>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($timerEnabled)
                                <div
                                    x-data="{
                                        remaining: 0,
                                        expiresAt: new Date('{{ $timerExpiresAt }}').getTime(),
                                        interval: null,
                                        tick() {
                                            this.remaining = Math.max(0, Math.round((this.expiresAt - Date.now()) / 1000));
                                            if (this.remaining <= 0) {
                                                clearInterval(this.interval);
                                                $wire.call('submitQuiz');
                                            }
                                        },
                                        init() {
                                            this.tick();
                                            this.interval = setInterval(() => this.tick(), 1000);
                                        }
                                    }"
                                    x-init="init"
                                    x-cloak
                                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-ui-lg bg-white dark:bg-surface-dark border border-border dark:border-border-dark"
                                    :class="remaining <= 60 ? 'border-danger text-danger' : 'text-foreground dark:text-foreground-dark'"
                                >
                                    <x-ui.icon name="clock" size="sm" />
                                    <span
                                        class="text-ui-sm font-semibold tabular-nums"
                                        x-text="String(Math.floor(remaining / 60)).padStart(2, '0') + ':' + String(remaining % 60).padStart(2, '0')"
                                    ></span>
                                </div>
                            @endif
                            @if(!$quiz->allow_multiple_attempts)
                                <x-ui.badge variant="warning" size="sm" dot>Single Attempt</x-ui.badge>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @php
                        $answeredCount = collect($questions)->filter(fn ($q) => isset($answers['q_' . $q['id']]) && $answers['q_' . $q['id']] !== null && $answers['q_' . $q['id']] !== '')->count();
                    @endphp

                    {{-- Progress --}}
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-2">
                            <x-ui.text size="sm" color="muted">
                                Question {{ $current + 1 }} of {{ count($questions) }}
                            </x-ui.text>
                            <x-ui.text size="sm" weight="bold" class="text-primary">
                                {{ round((($current + 1) / max(count($questions), 1)) * 100) }}%
                            </x-ui.text>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-primary h-2.5 rounded-full transition-all duration-500 ease-out"
                                style="width: {{ (($current + 1) / max(count($questions), 1)) * 100 }}%"></div>
                        </div>
                    </div>

                    {{-- Navigator --}}
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($questions as $i => $q)
                            @php
                                $answered = isset($answers['q_' . $q['id']]) && $answers['q_' . $q['id']] !== null && $answers['q_' . $q['id']] !== '';
                            @endphp
                            <button wire:click="goTo({{ $i }})" type="button"
                                title="Soal {{ $i + 1 }}{{ $answered ? ' - sudah dijawab' : ' - belum dijawab' }}"
                                class="relative w-9 h-9 rounded-ui-lg text-ui-xs font-semibold transition-all duration-150 flex items-center justify-center hover:scale-105
                                {{ $i === $current ? 'bg-primary text-white shadow-sm ring-2 ring-primary/30 ring-offset-1 ring-offset-white dark:ring-offset-surface-dark scale-105' : '' }}
                                {{ $i !== $current && $answered ? 'bg-success/15 text-success border border-success/30 hover:bg-success/25' : '' }}
                                {{ $i !== $current && !$answered ? 'bg-gray-100 dark:bg-gray-800 text-muted dark:text-muted-dark border border-border dark:border-border-dark hover:bg-gray-200 dark:hover:bg-gray-700' : '' }}">
                                @if($i !== $current && $answered)
                                    <x-ui.icon name="check" size="xs" />
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </button>
                        @endforeach
                    </div>

                    {{-- Legend --}}
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 mb-6">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-ui-sm bg-primary"></span>
                            <x-ui.text size="xs" color="muted">Sedang dikerjakan</x-ui.text>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-ui-sm bg-success"></span>
                            <x-ui.text size="xs" color="muted">Sudah dijawab</x-ui.text>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-ui-sm bg-gray-100 dark:bg-gray-800 border border-border dark:border-border-dark"></span>
                            <x-ui.text size="xs" color="muted">Belum dijawab</x-ui.text>
                        </div>
                        <x-ui.text size="xs" color="muted" class="ml-auto">
                            {{ $answeredCount }} / {{ count($questions) }} dijawab
                        </x-ui.text>
                    </div>

                    {{-- Question --}}
                    @php $question = $questions[$current] ?? null; @endphp
                    @if($question)
                        <div class="mb-6" wire:key="quiz-question-{{ $question['id'] }}">
                            <div class="p-5 bg-primary-light/10 dark:bg-primary-dark/20 border border-primary/20 dark:border-primary-dark/30 rounded-ui-xl mb-6">
                                <x-ui.text size="base" weight="semibold" class="text-foreground dark:text-foreground-dark leading-relaxed">
                                    {!! nl2br(e($question['question'])) !!}
                                </x-ui.text>
                            </div>

                            @if($question['type'] === 'multiple_choice')
                                <div class="space-y-3">
                                    @foreach($question['options'] as $opt)
                                        <label wire:key="quiz-option-{{ $question['id'] }}-{{ $opt['id'] }}" class="flex items-center p-4 bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl cursor-pointer hover:border-primary hover:bg-primary-light/5 dark:hover:bg-primary-dark/10 transition-all duration-150 group
                                            {{ isset($answers['q_' . $question['id']]) && $answers['q_' . $question['id']] == $opt['id'] ? 'border-primary bg-primary-light/10 dark:bg-primary-dark/20 ring-1 ring-primary' : '' }}">
                                            <input type="radio"
                                                name="q_{{ $question['id'] }}"
                                                value="{{ $opt['id'] }}"
                                                wire:model.live="answers.q_{{ $question['id'] }}"
                                                class="h-4 w-4 border-border dark:border-border-dark text-primary focus:ring-primary transition-all duration-150">
                                            <span class="ml-3 text-ui-sm text-foreground dark:text-foreground-dark font-medium group-hover:text-primary transition-colors">
                                                {{ $opt['option'] }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($question['type'] === 'essay')
                                <textarea
                                    wire:key="quiz-essay-{{ $question['id'] }}"
                                    wire:model.blur="answers.q_{{ $question['id'] }}"
                                    placeholder="Type your answer here..."
                                    class="block w-full rounded-ui-xl border border-border dark:border-border-dark bg-white dark:bg-surface-dark text-foreground dark:text-foreground-dark placeholder-muted dark:placeholder-muted-dark px-4 py-3 text-ui-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-150 min-h-[120px]"
                                    rows="4"
                                ></textarea>
                            @endif
                        </div>

                        {{-- Navigation --}}
                        <div class="flex items-center justify-between pt-4 border-t border-border dark:border-border-dark">
                            <x-ui.button wire:click="back" variant="ghost" icon="chevron-left" :disabled="$current === 0">
                                Previous
                            </x-ui.button>
                            <x-ui.text size="sm" color="muted">
                                {{ $current + 1 }} / {{ count($questions) }}
                            </x-ui.text>
                            @if($current < count($questions) - 1)
                                <x-ui.button wire:click="next" variant="primary" icon="chevron-right" icon-position="right">
                                    Next
                                </x-ui.button>
                            @else
                                <x-ui.button
                                    type="button"
                                    variant="success"
                                    icon="check-circle"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-submit-quiz')"
                                >
                                    Submit Quiz
                                </x-ui.button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <x-ui.modal name="confirm-submit-quiz" wire:model="confirmingSubmit" title="Submit Jawaban Quiz?">
                <x-ui.text size="sm" color="muted" class="mb-4">
                    Anda telah menjawab <span class="font-semibold text-foreground dark:text-foreground-dark">{{ $answeredCount }}</span> dari
                    <span class="font-semibold text-foreground dark:text-foreground-dark">{{ count($questions) }}</span> soal.
                    Setelah disubmit, jawaban tidak dapat diubah lagi.
                </x-ui.text>

                @if($answeredCount < count($questions))
                    <x-ui.alert type="warning" class="mb-4">
                        Masih ada {{ count($questions) - $answeredCount }} soal yang belum dijawab.
                    </x-ui.alert>
                @endif

                <x-slot:footer>
                    <x-ui.button type="button" variant="ghost" x-on:click="$dispatch('close')">
                        Batal
                    </x-ui.button>
                    <x-ui.button type="button" variant="success" icon="check-circle" wire:click="submitQuiz" x-on:click="$dispatch('close')">
                        Ya, Submit
                    </x-ui.button>
                </x-slot:footer>
            </x-ui.modal>
        @endif
    </div>
</div>
