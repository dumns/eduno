<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentQuizForm extends Component
{
    public Quiz $quiz;
    public array $questions = [];
    public array $answers = [];
    public int $current = 0;
    public bool $submitted = false;
    public bool $timerEnabled = false;
    public ?string $timerExpiresAt = null;
    public bool $confirmingSubmit = false;
    public ?array $result = null;

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->questions = $quiz->questions()->with('options')->get()->toArray();

        $userId = Auth::id();

        $alreadySubmitted = QuizAnswer::where('quiz_id', $quiz->id)
            ->where('user_id', $userId)
            ->where('is_submitted', true)
            ->exists();

        if (!$quiz->allow_multiple_attempts && $alreadySubmitted) {
            $this->submitted = true;

            if ($quiz->show_result) {
                $this->loadResult($userId);
            }

            return;
        }

        $saved = QuizAnswer::where('quiz_id', $quiz->id)
            ->where('user_id', $userId)
            ->where('is_submitted', false)
            ->get();

        foreach ($saved as $ans) {
            $this->answers['q_' . $ans->question_id] = $ans->answer;
        }

        if ($quiz->timer_enabled && $quiz->duration_minutes) {
            $attempt = QuizAttempt::firstOrNew([
                'user_id' => $userId,
                'quiz_id' => $quiz->id,
            ]);

            $isFreshStart = !$attempt->exists || $attempt->submitted_at !== null;
            if ($isFreshStart) {
                $attempt->started_at = now();
                $attempt->submitted_at = null;
            }
            $attempt->save();

            $expiresAt = $attempt->started_at->copy()->addMinutes($quiz->duration_minutes);

            if (now()->greaterThanOrEqualTo($expiresAt)) {
                $this->submitQuiz();
                return;
            }

            $this->timerEnabled = true;
            $this->timerExpiresAt = $expiresAt->toIso8601String();
        }
    }

    public function updated($name, $value)
    {
        if (str_starts_with($name, 'answers.')) {
            $key = str_replace('answers.', '', $name);
            $questionId = str_replace('q_', '', $key);
            $this->autoSave((int) $questionId, $value);
        }
    }

    public function autoSave(int $questionId, ?string $value): void
    {
        if (!Auth::check()) return;
        if ($this->isTimeExpired()) {
            $this->submitQuiz();
            return;
        }

        QuizAnswer::updateOrCreate([
            'user_id' => Auth::id(),
            'quiz_id' => $this->quiz->id,
            'question_id' => $questionId,
        ], [
            'answer' => $value,
            'is_submitted' => false,
        ]);
    }

    public function clearAnswer(): void
    {
        if (!Auth::check()) return;
        if ($this->isTimeExpired()) {
            $this->submitQuiz();
            return;
        }

        $question = $this->questions[$this->current] ?? null;
        if (!$question) return;

        unset($this->answers['q_' . $question['id']]);

        QuizAnswer::where('quiz_id', $this->quiz->id)
            ->where('user_id', Auth::id())
            ->where('question_id', $question['id'])
            ->delete();
    }

    public function next(): void
    {
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        }
    }

    public function back(): void
    {
        if ($this->current > 0) {
            $this->current--;
        }
    }

    public function goTo(int $index): void
    {
        if ($index >= 0 && $index < count($this->questions)) {
            $this->current = $index;
        }
    }

    private function isTimeExpired(): bool
    {
        return $this->timerEnabled
            && $this->timerExpiresAt !== null
            && now()->greaterThanOrEqualTo($this->timerExpiresAt);
    }

    public function submitQuiz(): void
    {
        if ($this->submitted) return;

        $userId = Auth::id();

        QuizAnswer::where('quiz_id', $this->quiz->id)
            ->where('user_id', $userId)
            ->update(['is_submitted' => true]);

        $questions = $this->quiz->questions()->with('options')->get();
        $score = 0;
        $maxScore = $questions->count();

        foreach ($questions as $q) {
            $ans = QuizAnswer::where('quiz_id', $this->quiz->id)
                ->where('user_id', $userId)
                ->where('question_id', $q->id)
                ->first();

            if (!$ans) continue;

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

        QuizResult::updateOrCreate(
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

        if ($this->timerEnabled) {
            QuizAttempt::where('user_id', $userId)
                ->where('quiz_id', $this->quiz->id)
                ->update(['submitted_at' => now()]);
        }

        if ($this->quiz->show_result) {
            $this->result = [
                'score' => $score,
                'max_score' => $maxScore,
                'percentage' => $percentage,
            ];
        }

        $this->submitted = true;
    }

    private function loadResult(int $userId): void
    {
        $result = QuizResult::where('quiz_id', $this->quiz->id)
            ->where('user_id', $userId)
            ->first();

        if ($result) {
            $this->result = [
                'score' => $result->score,
                'max_score' => $result->max_score,
                'percentage' => $result->percentage,
            ];
        }
    }

    public function render()
    {
        return view('livewire.student-quiz-form');
    }
}
