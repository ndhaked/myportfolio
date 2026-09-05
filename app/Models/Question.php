<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_technology_id', 'quiz_level_id', 'topic', 'question_text', 'code_snippet', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function technology()
    {
        return $this->belongsTo(QuizTechnology::class, 'quiz_technology_id');
    }

    public function level()
    {
        return $this->belongsTo(QuizLevel::class, 'quiz_level_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('sort_order');
    }
}
