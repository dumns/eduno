<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class ShowCourse extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->course->loadCount('episodes');
        $this->course->loadSum('episodes', 'length_in_minutes');
        $this->course->load(['episodes' => fn($q) => $q->orderBy('sort')]);
        $this->course->load(['quizzes' => fn($q) => $q->withCount('questions')]);
    }

    public function render()
    {
        return view('livewire.show-course');
    }
}
