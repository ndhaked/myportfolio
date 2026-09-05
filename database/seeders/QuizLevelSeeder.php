<?php

namespace Database\Seeders;

use App\Models\QuizLevel;
use Illuminate\Database\Seeder;

class QuizLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            ['name' => 'Beginner / Starter', 'slug' => 'starter', 'target_audience' => 'Freshers, Interns & Junior Developers (0-2 yrs)', 'question_count' => 10, 'duration_minutes' => 15, 'pass_percentage' => 40],
            ['name' => 'Intermediate / Mid-Level', 'slug' => 'intermediate', 'target_audience' => 'Full-Stack & Backend Developers (2-5 yrs)', 'question_count' => 15, 'duration_minutes' => 20, 'pass_percentage' => 50],
            ['name' => 'Senior Architect', 'slug' => 'senior', 'target_audience' => 'Senior Developers, Tech Leads & Architects (5+ yrs)', 'question_count' => 15, 'duration_minutes' => 25, 'pass_percentage' => 60],
        ];

        foreach ($levels as $level) {
            QuizLevel::firstOrCreate(['slug' => $level['slug']], $level);
        }
    }
}
