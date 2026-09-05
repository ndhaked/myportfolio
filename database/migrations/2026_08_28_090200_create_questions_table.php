<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_technology_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quiz_level_id')->constrained()->cascadeOnDelete();
            $table->string('topic')->nullable();
            $table->text('question_text');
            $table->text('code_snippet')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
