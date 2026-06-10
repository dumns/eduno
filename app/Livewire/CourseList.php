<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedTags = [];
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedTags' => ['except' => []],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedTags()
    {
        $this->resetPage();
    }

    public function toggleTag($tagId)
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_values(array_diff($this->selectedTags, [$tagId]));
        } else {
            $this->selectedTags[] = $tagId;
        }
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::query()
            ->withCount('episodes')
            ->withSum('episodes', 'length_in_minutes')
            ->with(['tags']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('tagline', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->selectedTags)) {
            $query->whereHas('tags', fn($q) => $q->whereIn('tags.id', $this->selectedTags));
        }

        $courses = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        $allTags = Tag::all();

        return view('livewire.course-list', [
            'courses' => $courses,
            'allTags' => $allTags,
        ]);
    }
}
