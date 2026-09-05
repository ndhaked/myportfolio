<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizTechnology extends Model
{
    protected $fillable = ['name', 'slug', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
