<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('target_audience')->nullable();
            $table->unsignedInteger('question_count')->default(10);
            $table->unsignedInteger('duration_minutes')->default(15);
            $table->unsignedTinyInteger('pass_percentage')->default(50);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_levels');
    }
};
