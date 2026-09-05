<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use Illuminate\View\View;

class QuizAttemptController extends Controller
{
    public function index(): View
    {
        return view('admin.skill-test.attempts.index');
    }

    public function show(QuizAttempt $attempt): View
    {
        $attempt->load(['technology', 'level', 'answers.question.options', 'answers.selectedOption']);

        return view('admin.skill-test.attempts.show', compact('attempt'));
    }
}
