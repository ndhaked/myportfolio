<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizLevel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizLevelController extends Controller
{
    public function index(): View
    {
        $levels = QuizLevel::orderBy('duration_minutes')->get();

        return view('admin.skill-test.levels.index', compact('levels'));
    }

    public function update(Request $request, QuizLevel $level): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'question_count' => ['required', 'integer', 'min:1', 'max:100'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:180'],
            'pass_percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'status' => ['nullable', 'boolean'],
        ]);

        $level->update([
            ...$validated,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('admin.skill-test.levels.index')->with('success', 'Level updated.');
    }
}
