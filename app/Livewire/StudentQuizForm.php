<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentQuizForm extends Component implements HasForms
{
    use InteractsWithForms;

    public Quiz $quiz;
    public array $questions = [];
    public array $answers = [];
    public int $current = 0;
    public bool $submitted = false;

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->questions = $quiz->questions()->with('options')->get()->toArray();

        $userId = Auth::id();
        // Cek apakah user sudah pernah submit quiz ini
        $alreadySubmitted = QuizAnswer::where('quiz_id', $quiz->id)
            ->where('user_id', $userId)
            ->where('is_submitted', true)
            ->exists();

        if (!$quiz->allow_multiple_attempts && $alreadySubmitted) {
            $this->submitted = true;
            return;
        }

        // Load saved answers (jika belum submit)
        $saved = QuizAnswer::where('quiz_id', $quiz->id)
            ->where('user_id', $userId)
            ->where('is_submitted', false)
            ->get();

        foreach ($saved as $ans) {
            $this->answers['q_' . $ans->question_id] = $ans->answer;
        }

        $this->form->fill($this->answers);
    }

    public function form(Form $form): Form
    {
        $question = $this->questions[$this->current] ?? null;

        if (!$question) {
            return $form->schema([]);
        }

        $schema = [
            Placeholder::make('question_text')
                ->label('Soal ' . ($this->current + 1) . ' dari ' . count($this->questions))
                ->content($question['question']),
        ];

        if ($question['type'] === 'multiple_choice') {
            $options = collect($question['options'])->pluck('option', 'option')->toArray();
            $schema[] = Radio::make('q_' . $question['id'])
                ->label('')
                ->options($options)
                ->live()
                ->afterStateUpdated(fn($state) => $this->autoSave($question['id'], $state));
        } elseif ($question['type'] === 'essay') {
            $schema[] = Textarea::make('q_' . $question['id'])
                ->label('')
                ->rows(4)
                ->live(onBlur: true)
                ->afterStateUpdated(fn($state) => $this->autoSave($question['id'], $state));
        }

        return $form->schema($schema)->statePath('answers');
    }

    public function autoSave(int $questionId, ?string $value): void
    {
        if (!Auth::check())
            return;

        QuizAnswer::updateOrCreate([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'question_id' => $questionId,
        ], [
            'answer' => $value,
            'is_submitted' => false,
        ]);
    }

    public function next(): void
    {
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
            $this->form->fill($this->answers);
        }
    }

    public function back(): void
    {
        if ($this->current > 0) {
            $this->current--;
            $this->form->fill($this->answers);
        }
    }

    public function goTo(int $index): void
    {
        $this->current = $index;
        $this->form->fill($this->answers);
    }

    public function submitQuiz(): void
    {
        $userId = Auth::id();
        QuizAnswer::where('quiz_id', $this->quiz->id)
            ->where('user_id', $userId)
            ->update(['is_submitted' => true]);

        // Hitung skor
        $questions = $this->quiz->questions()->with('options')->get();
        $score = 0;
        $maxScore = $questions->count();
        foreach ($questions as $q) {
            $ans = QuizAnswer::where('quiz_id', $this->quiz->id)
                ->where('user_id', $userId)
                ->where('question_id', $q->id)
                ->first();
            if (!$ans)
                continue;
            if ($q->type === 'multiple_choice') {
                $correct = $q->options->where('is_correct', true)->pluck('id')->toArray();
                if (in_array($ans->answer, $correct)) {
                    $score++;
                }
            } elseif ($q->type === 'essay') {
                if (trim(strtolower($ans->answer)) === trim(strtolower($q->answer))) {
                    $score++;
                }
            }
        }
        $percentage = $maxScore > 0 ? ($score / $maxScore) * 100 : 0;

        \App\Models\QuizResult::updateOrCreate(
            [
                'user_id' => $userId,
                'quiz_id' => $this->quiz->id,
            ],
            [
                'score' => $score,
                'max_score' => $maxScore,
                'percentage' => $percentage,
            ]
        );

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.student-quiz-form');
    }
}
