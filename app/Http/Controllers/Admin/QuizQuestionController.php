<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizQuestionController extends Controller
{
    public function index(Request $request): View
    {
        $questions = Question::with(['technology', 'level'])
            ->when($request->filled('technology'), fn ($q) => $q->where('quiz_technology_id', $request->technology))
            ->when($request->filled('level'), fn ($q) => $q->where('quiz_level_id', $request->level))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $technologies = QuizTechnology::orderBy('name')->get();
        $levels = QuizLevel::orderBy('duration_minutes')->get();

        return view('admin.skill-test.questions.index', compact('questions', 'technologies', 'levels'));
    }

    public function create(): View
    {
        $technologies = QuizTechnology::where('status', true)->orderBy('name')->get();
        $levels = QuizLevel::where('status', true)->orderBy('duration_minutes')->get();

        return view('admin.skill-test.questions.create', compact('technologies', 'levels'));
    }

    public function edit(Question $question): View
    {
        $question->load('options');
        $technologies = QuizTechnology::where('status', true)->orderBy('name')->get();
        $levels = QuizLevel::where('status', true)->orderBy('duration_minutes')->get();

        return view('admin.skill-test.questions.edit', compact('question', 'technologies', 'levels'));
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->route('admin.skill-test.questions.index')->with('success', 'Question deleted.');
    }
}
