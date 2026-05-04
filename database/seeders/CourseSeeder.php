<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::factory()->count(5)->create();
        Course::factory()
            ->count(5)
            ->hasAttached($tags->random(2))
            ->create();
    }
}
