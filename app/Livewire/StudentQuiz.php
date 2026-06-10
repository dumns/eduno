<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Arr;

class StudentQuiz extends Component
{
    public Quiz $quiz;
    public $questions = [];
    public $current = 0;
    public $answers = [];
    public $finished = false;
    public $score = null;

    public function mount($quizId)
    {
        $this->quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $this->questions = $this->quiz->questions->sortBy('sort')->values()->all();
    }

    public function answer($value)
    {
        $question = $this->questions[$this->current];
        $this->answers[$question->id] = $value;
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        } else {
            $this->finished = true;
            $this->score = $this->calculateScore();
        }
    }

    public function previousQuestion()
    {
        if ($this->current > 0) {
            $this->current--;
        }
    }

    public function nextQuestion()
    {
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        }
    }

    public function goToQuestion($index)
    {
        if ($index >= 0 && $index < count($this->questions)) {
            $this->current = $index;
        }
    }

    public function resetQuiz()
    {
        $this->current = 0;
        $this->answers = [];
        $this->finished = false;
        $this->score = null;
    }

    public function finishQuiz()
    {
        $this->finished = true;
        $this->score = $this->calculateScore();
    }

    public function calculateScore()
    {
        $score = 0;
        foreach ($this->questions as $q) {
            if ($q->type === 'multiple_choice') {
                $correct = $q->options->where('is_correct', true)->pluck('id')->toArray();
                if (in_array($this->answers[$q->id] ?? null, $correct)) {
                    $score++;
                }
            } elseif ($q->type === 'essay') {
                if (trim(strtolower($this->answers[$q->id] ?? '')) === trim(strtolower($q->answer))) {
                    $score++;
                }
            }
        }
        return $score;
    }

    public function render()
    {
        return view('livewire.student-quiz', [
            'quiz' => $this->quiz,
            'questions' => $this->questions,
            'current' => $this->current,
            'answers' => $this->answers,
            'finished' => $this->finished,
            'score' => $this->score,
        ]);
    }
}
