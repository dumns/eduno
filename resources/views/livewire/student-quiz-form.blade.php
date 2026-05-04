<div>
    @if($submitted)
        <x-filament::card class="mb-8 bg-success-50 border-success-200">
            <div class="flex flex-col items-center gap-4 py-8">
                <x-filament::icon icon="heroicon-o-check-circle" class="w-16 h-16 text-success-500" />
                <h2 class="text-2xl font-bold text-success-700">Quiz Berhasil Disubmit</h2>
                <p class="text-success-700">Jawaban Anda telah tersimpan. Terima kasih telah mengerjakan quiz ini.</p>
                <x-filament::button tag="a" href="{{ route('courses.show', $quiz->course) }}" color="primary"
                    icon="heroicon-o-arrow-left">
                    Kembali ke Course
                </x-filament::button>
            </div>
        </x-filament::card>
    @else
        <x-filament::section>

            <x-slot name="heading">
                {{ $quiz->title }}
            </x-slot>

            <h2 class="text-2xl font-bold text-success-700">
                @if(!$quiz->allow_multiple_attempts)
                    Quiz Sudah Pernah Dikerjakan
                @else
                    Quiz Berhasil Disubmit
                @endif
            </h2>
            <p class="text-success-700">
                @if(!$quiz->allow_multiple_attempts)
                    Anda hanya dapat mengisi quiz ini satu kali. Jawaban Anda telah tersimpan.
                @else
                    Jawaban Anda telah tersimpan. Terima kasih telah mengerjakan quiz ini.
                @endif
            </p>

            {{-- Progress bar --}}
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-6">
                <div class="bg-primary-500 h-2 rounded-full transition-all duration-300"
                    style="width: {{ (($current + 1) / max(count($questions), 1)) * 100 }}%"></div>
            </div>

            {{-- Navigator soal --}}
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($questions as $i => $q)
                    @php $answered = isset($answers['q_' . $q['id']]) && $answers['q_' . $q['id']] !== null && $answers['q_' . $q['id']] !== ''; @endphp
                    <x-filament::button wire:click="goTo({{ $i }})" size="sm"
                        color="{{ $i === $current ? 'primary' : ($answered ? 'success' : 'gray') }}"
                        outlined="{{ $i !== $current }}">
                        {{ $i + 1 }}
                    </x-filament::button>
                @endforeach
            </div>

            {{-- Filament Form --}}
            <form wire:submit.prevent>
                {{ $this->form }}
            </form>

            {{-- Navigasi --}}
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <x-filament::button wire:click="back" color="gray" icon="heroicon-o-arrow-left" :disabled="$current === 0">
                    Sebelumnya
                </x-filament::button>

                <span class="text-sm text-gray-500">{{ $current + 1 }} / {{ count($questions) }}</span>

                @if($current < count($questions) - 1)
                    <x-filament::button wire:click="next" color="primary" icon="heroicon-o-arrow-right" iconPosition="after">
                        Berikutnya
                    </x-filament::button>
                @else
                    <x-filament::button wire:click="submitQuiz" color="success" icon="heroicon-o-check">
                        Submit Quiz
                    </x-filament::button>
                @endif
            </div>
        </x-filament::section>
    @endif
</div>