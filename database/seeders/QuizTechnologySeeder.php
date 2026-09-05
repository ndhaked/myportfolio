<?php

namespace Database\Seeders;

use App\Models\QuizTechnology;
use Illuminate\Database\Seeder;

class QuizTechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'MySQL', 'slug' => 'mysql'],
            ['name' => 'Node.js', 'slug' => 'nodejs'],
            ['name' => 'Angular', 'slug' => 'angular'],
            ['name' => 'DevOps', 'slug' => 'devops'],
        ];

        foreach ($technologies as $technology) {
            QuizTechnology::firstOrCreate(['slug' => $technology['slug']], [...$technology, 'status' => true]);
        }
    }
}
