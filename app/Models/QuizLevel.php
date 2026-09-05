<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizLevel extends Model
{
    protected $fillable = ['name', 'slug', 'target_audience', 'question_count', 'duration_minutes', 'pass_percentage', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
