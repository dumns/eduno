<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $quiz = Quiz::factory()->create([
                'course_id' => $course->id,
            ]);
            for ($i = 1; $i <= 3; $i++) {
                $question = Question::factory()->create([
                    'quiz_id' => $quiz->id,
                    'type' => 'multiple_choice',
                ]);
                foreach (['A', 'B', 'C', 'D'] as $idx => $opt) {
                    Option::factory()->create([
                        'question_id' => $question->id,
                        'option' => "Jawaban $opt",
                        'is_correct' => $idx === 0,
                    ]);
                }
            }
        }
    }
}
