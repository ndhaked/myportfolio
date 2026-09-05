<?php

namespace App\Mail;

use App\Models\QuizAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizLeadAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuizAttempt $attempt)
    {
    }

    public function build()
    {
        return $this->subject('New Skill Test Lead: '.$this->attempt->name)
            ->view('emails.quiz-lead-alert', ['attempt' => $this->attempt]);
    }
}
