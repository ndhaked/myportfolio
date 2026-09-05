<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_technology_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quiz_level_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->json('question_ids');
            $table->unsignedInteger('current_question_index')->default(0);
            $table->unsignedInteger('total_questions')->default(0);
            $table->unsignedInteger('correct_answers')->default(0);
            $table->unsignedTinyInteger('score_percentage')->default(0);
            $table->enum('status', ['in_progress', 'completed', 'timed_out'])->default('in_progress');
            $table->string('session_token', 64)->unique();
            $table->timestamp('started_at');
            $table->timestamp('submitted_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
