<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class QuizTechnologyController extends Controller
{
    public function index(): View
    {
        $technologies = QuizTechnology::withCount('questions')->orderBy('name')->get();

        return view('admin.skill-test.technologies.index', compact('technologies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:quiz_technologies,name'],
        ]);

        QuizTechnology::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => true,
        ]);

        return redirect()->route('admin.skill-test.technologies.index')->with('success', 'Technology added.');
    }

    public function update(Request $request, QuizTechnology $technology): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:quiz_technologies,name,'.$technology->id],
            'status' => ['nullable', 'boolean'],
        ]);

        $technology->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('admin.skill-test.technologies.index')->with('success', 'Technology updated.');
    }

    public function destroy(QuizTechnology $technology): RedirectResponse
    {
        $technology->delete();

        return redirect()->route('admin.skill-test.technologies.index')->with('success', 'Technology deleted.');
    }
}
