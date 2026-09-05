<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndAdminSeeder::class);
        $this->call(QuizLevelSeeder::class);
        $this->call(QuizTechnologySeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(MySqlQuestionSeeder::class);
        $this->call(NodeJsQuestionSeeder::class);
        $this->call(AngularQuestionSeeder::class);
        $this->call(DevOpsQuestionSeeder::class);
    }
}
