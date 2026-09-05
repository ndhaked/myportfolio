<?php

namespace App\Events;

use App\Models\QuizAttempt;
use Illuminate\Foundation\Events\Dispatchable;

class QuizAttemptCompleted
{
    use Dispatchable;

    public function __construct(public QuizAttempt $attempt)
    {
    }
}
