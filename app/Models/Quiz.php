<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'allow_multiple_attempts',
        'timer_enabled',
        'duration_minutes',
        'show_result',
    ];

    protected $casts = [
        'allow_multiple_attempts' => 'boolean',
        'timer_enabled' => 'boolean',
        'duration_minutes' => 'integer',
        'show_result' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
