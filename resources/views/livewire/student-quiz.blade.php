<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold mb-6 text-blue-700 text-center">Quiz: {{ $quiz->title }}</h2>

    {{-- Progress Bar --}}
    <div class="w-full bg-gray-200 rounded-full h-3 mb-6">
        <div class="bg-blue-500 h-3 rounded-full transition-all duration-300"
            style="width: {{ ($finished ? 100 : (($current + 1) / count($questions) * 100)) }}%"></div>
    </div>

    @if ($finished)
        <div class="p-6 bg-green-100 rounded mb-4 text-center">
            <strong class="text-lg">Quiz selesai!</strong><br>
            <span class="text-xl">Skor kamu: <span
                    class="font-bold text-green-700">{{ $score }}/{{ count($questions) }}</span></span>
            <div class="mt-4">
                <a href="/"
                    class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Kembali ke
                    Beranda</a>
            </div>
        </div>
    @else
        @php $q = $questions[$current]; @endphp
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-500">Soal {{ $current + 1 }} dari {{ count($questions) }}</span>
                <span class="text-xs text-gray-400">Quiz: {{ $quiz->title }}</span>
            </div>
            <div class="p-4 bg-blue-50 border-l-4 border-blue-400 rounded mb-4 text-lg font-semibold">
                {!! nl2br(e($q->question)) !!}</div>

            @if ($q->type === 'multiple_choice')
                <form wire:submit.prevent="answer">
                    <div class="space-y-3">
                        @foreach ($q->options as $opt)
                            <label
                                class="flex items-center px-4 py-2 bg-gray-100 rounded-lg cursor-pointer hover:bg-blue-100 transition">
                                <input type="radio" name="answer" value="{{ $opt->id }}" wire:model.defer="answers.{{ $q->id }}"
                                    required class="form-radio h-5 w-5 text-blue-600">
                                <span class="ml-3 text-base">{{ $opt->option }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button type="button" wire:click="answer(answers.{$q->id})"
                        class="mt-6 w-full px-6 py-3 bg-blue-600 text-white text-lg rounded-lg hover:bg-blue-700 transition font-bold shadow">Jawab
                        & Lanjut</button>
                </form>
            @elseif ($q->type === 'essay')
                <form wire:submit.prevent="answer">
                    <input type="text"
                        class="border-2 border-blue-300 rounded px-3 py-2 w-full text-lg focus:outline-none focus:border-blue-500"
                        wire:model.defer="answers.{{ $q->id }}" required placeholder="Ketik jawaban kamu di sini...">
                    <button type="button" wire:click="answer(answers.{$q->id})"
                        class="mt-6 w-full px-6 py-3 bg-blue-600 text-white text-lg rounded-lg hover:bg-blue-700 transition font-bold shadow">Jawab
                        & Lanjut</button>
                </form>
            @endif
        </div>
    @endif
</div>