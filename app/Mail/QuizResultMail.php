<?php

namespace App\Mail;

use App\Models\QuizAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuizAttempt $attempt)
    {
    }

    public function build()
    {
        return $this->subject('Your '.$this->attempt->technology->name.' Skill Test Result')
            ->view('emails.quiz-result', ['attempt' => $this->attempt]);
    }
}
