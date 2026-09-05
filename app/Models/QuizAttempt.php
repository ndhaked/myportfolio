<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_technology_id', 'quiz_level_id', 'name', 'email', 'phone',
        'question_ids', 'current_question_index', 'total_questions',
        'correct_answers', 'score_percentage', 'status', 'termination_reason', 'session_token',
        'started_at', 'submitted_at', 'ip_address',
    ];

    protected $casts = [
        'question_ids' => 'array',
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    public function technology()
    {
        return $this->belongsTo(QuizTechnology::class, 'quiz_technology_id');
    }

    public function level()
    {
        return $this->belongsTo(QuizLevel::class, 'quiz_level_id');
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function deadline(): \Illuminate\Support\Carbon
    {
        return $this->started_at->copy()->addMinutes($this->level->duration_minutes);
    }

    public function isExpired(): bool
    {
        return now()->greaterThan($this->deadline());
    }
}
