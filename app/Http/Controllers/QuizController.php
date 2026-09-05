<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartQuizRequest;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function index(): View
    {
        $technologies = QuizTechnology::where('status', true)->orderBy('name')->get();
        $levels = QuizLevel::where('status', true)->orderBy('duration_minutes')->get();

        return view('skill-test.index', compact('technologies', 'levels'));
    }

    public function start(StartQuizRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $level = QuizLevel::findOrFail($validated['quiz_level_id']);

        $questionIds = Question::where('quiz_technology_id', $validated['quiz_technology_id'])
            ->where('quiz_level_id', $validated['quiz_level_id'])
            ->where('status', true)
            ->inRandomOrder()
            ->limit($level->question_count)
            ->pluck('id')
            ->all();

        if (empty($questionIds)) {
            return back()->withErrors(['quiz_level_id' => 'No questions are available for this technology and level yet. Please try another combination.']);
        }

        $sessionToken = Str::random(48);

        $attempt = QuizAttempt::create([
            'quiz_technology_id' => $validated['quiz_technology_id'],
            'quiz_level_id' => $validated['quiz_level_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'question_ids' => $questionIds,
            'total_questions' => count($questionIds),
            'status' => 'in_progress',
            'session_token' => $sessionToken,
            'started_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        // Defensive guard: started_at and created_at are set moments apart in the
        // same request and must always agree. If they ever disagree by more than a
        // minute (observed once in testing, cause unconfirmed), self-heal by trusting
        // created_at rather than letting a corrupt deadline reach the exam timer.
        if (abs($attempt->started_at->diffInSeconds($attempt->created_at, true)) > 60) {
            $attempt->started_at = $attempt->created_at;
            $attempt->save();
        }

        session(['quiz_attempt_token_'.$attempt->id => $sessionToken]);

        return redirect()->route('skill-test.exam', $attempt);
    }

    public function exam(Request $request, QuizAttempt $attempt): \Illuminate\Http\Response|RedirectResponse
    {
        $this->authorizeAttempt($request, $attempt);

        if ($attempt->status !== 'in_progress') {
            return $this->noStore(redirect()->route('skill-test.result', $attempt));
        }

        if ($attempt->isExpired()) {
            return $this->noStore(redirect()->route('skill-test.result', $attempt));
        }

        return $this->noStore(response()->view('skill-test.exam', compact('attempt')));
    }

    private function noStore($response)
    {
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function result(Request $request, QuizAttempt $attempt): View
    {
        $this->authorizeAttempt($request, $attempt);

        $attempt->load(['technology', 'level', 'answers.question']);

        $topicBreakdown = $attempt->answers
            ->groupBy(fn ($answer) => $answer->question->topic ?? 'General')
            ->map(fn ($answers) => [
                'correct' => $answers->where('is_correct', true)->count(),
                'total' => $answers->count(),
            ]);

        return view('skill-test.result', compact('attempt', 'topicBreakdown'));
    }

    private function authorizeAttempt(Request $request, QuizAttempt $attempt): void
    {
        $expectedToken = session('quiz_attempt_token_'.$attempt->id);

        abort_unless($expectedToken && hash_equals($expectedToken, $attempt->session_token), 403);
    }
}
