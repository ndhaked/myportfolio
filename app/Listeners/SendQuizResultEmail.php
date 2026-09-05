<?php

namespace App\Listeners;

use App\Events\QuizAttemptCompleted;
use App\Mail\QuizLeadAlertMail;
use App\Mail\QuizResultMail;
use Illuminate\Support\Facades\Mail;

class SendQuizResultEmail
{
    public function handle(QuizAttemptCompleted $event): void
    {
        Mail::to($event->attempt->email)->send(new QuizResultMail($event->attempt));

        $adminEmail = config('mail.admin_address', 'nirbhaydhaked@gmail.com');
        Mail::to($adminEmail)->send(new QuizLeadAlertMail($event->attempt));
    }
}
