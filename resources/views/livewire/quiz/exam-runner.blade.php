<?php

use App\Events\QuizAttemptCompleted;
use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\Question;
use Livewire\Volt\Component;

new class extends Component
{
    public QuizAttempt $attempt;
    public $questions;
    public int $currentIndex = 0;
    public array $selectedOptions = [];
    public int $deadlineTimestamp = 0;

    public function mount(QuizAttempt $attempt): void
    {
        $this->attempt = $attempt;
        $this->currentIndex = max(0, min($attempt->current_question_index ?? 0, max(0, count($attempt->question_ids ?? []) - 1)));

        // Defensive guard against a corrupt started_at (see QuizController::start()).
        if (abs($attempt->started_at->diffInSeconds($attempt->created_at, true)) > 60) {
            $attempt->started_at = $attempt->created_at;
            $attempt->save();
        }

        $this->deadlineTimestamp = $attempt->deadline()->getTimestamp() * 1000;

        $this->questions = Question::with('options')
            ->whereIn('id', $attempt->question_ids)
            ->get()
            ->sortBy(fn ($question) => array_search($question->id, $attempt->question_ids))
            ->values();

        foreach ($attempt->answers as $answer) {
            $this->selectedOptions[$answer->question_id] = $answer->selected_option_id;
        }
    }

    public function currentQuestion(): ?Question
    {
        return $this->questions[$this->currentIndex] ?? null;
    }

    private function isPastDeadline(): bool
    {
        return now()->getTimestamp() * 1000 >= $this->deadlineTimestamp;
    }

    public function selectOption(int $questionId, int $optionId): void
    {
        if ($this->isPastDeadline()) {
            $this->finalize('timed_out');

            return;
        }

        $this->selectedOptions[$questionId] = $optionId;

        $question = $this->questions->firstWhere('id', $questionId);
        $isCorrect = $question?->options->firstWhere('id', $optionId)?->is_correct ?? false;

        QuizAnswer::updateOrCreate(
            ['quiz_attempt_id' => $this->attempt->id, 'question_id' => $questionId],
            ['selected_option_id' => $optionId, 'is_correct' => $isCorrect, 'answered_at' => now()]
        );
    }

    public function nextQuestion(): void
    {
        if ($this->currentIndex < $this->questions->count() - 1) {
            $this->currentIndex++;
            $this->attempt->update(['current_question_index' => $this->currentIndex]);
        }
    }

    public function previousQuestion(): void
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function goToQuestion(int $index): void
    {
        if ($index >= 0 && $index < $this->questions->count()) {
            $this->currentIndex = $index;
        }
    }

    public function submitExam(): void
    {
        $this->finalize($this->isPastDeadline() ? 'timed_out' : 'completed');
    }

    public function checkTimeout(): void
    {
        if ($this->attempt->status === 'in_progress' && $this->isPastDeadline()) {
            $this->finalize('timed_out');
        }
    }

    public function forceFinish(string $reason = 'tab_switch'): void
    {
        if ($this->attempt->status === 'in_progress') {
            $this->finalize('timed_out', $reason);
        }
    }

    private function finalize(string $status, ?string $reason = null): void
    {
        $this->attempt->refresh();

        if ($this->attempt->status !== 'in_progress') {
            $this->redirect(route('skill-test.result', $this->attempt));

            return;
        }

        $answers = QuizAnswer::where('quiz_attempt_id', $this->attempt->id)->get();
        $correct = $answers->where('is_correct', true)->count();
        $total = $this->attempt->total_questions;

        $this->attempt->update([
            'status' => $status,
            'termination_reason' => $reason,
            'correct_answers' => $correct,
            'score_percentage' => $total > 0 ? (int) round(($correct / $total) * 100) : 0,
            'submitted_at' => now(),
        ]);

        QuizAttemptCompleted::dispatch($this->attempt->fresh());

        $this->redirect(route('skill-test.result', $this->attempt));
    }

    public function with(): array
    {
        return [
            'answeredCount' => count($this->selectedOptions),
        ];
    }
}; ?>

<div
    wire:poll.10s="checkTimeout"
    x-data="{
        deadline: @entangle('deadlineTimestamp'),
        remaining: 0,
        timedOut: false,
        tick() {
            this.remaining = Math.max(0, Math.floor((this.deadline - Date.now()) / 1000));
            if (this.remaining <= 0 && !this.timedOut) {
                this.timedOut = true;
                $wire.checkTimeout();
            }
        },
        formatted() {
            const m = Math.floor(this.remaining / 60);
            const s = this.remaining % 60;
            return m + ':' + String(s).padStart(2, '0');
        },
        onVisibilityChange() {
            if (document.hidden && !this.timedOut) {
                this.timedOut = true;
                $wire.forceFinish('tab_switch');
            }
        }
    }"
    x-init="
        tick(); setInterval(() => tick(), 1000);
        document.addEventListener('visibilitychange', onVisibilityChange);
        window.addEventListener('blur', onVisibilityChange);
    "
>
    <div class="quiz-header">
        <div class="quiz-progress">
            Question {{ $currentIndex + 1 }} of {{ $questions->count() }}
            <span class="quiz-answered-count">({{ $answeredCount }} answered)</span>
        </div>
        <div class="quiz-timer" :class="{ 'quiz-timer-warning': remaining <= 60 }">
            <span x-text="formatted()"></span>
        </div>
    </div>

    <div class="quiz-progress-bar">
        <div class="quiz-progress-bar-fill" style="width: {{ $questions->count() > 0 ? (($currentIndex + 1) / $questions->count()) * 100 : 0 }}%"></div>
    </div>

    @if ($this->currentQuestion())
        @php $question = $this->currentQuestion(); @endphp
        <div
            class="quiz-question-card"
            wire:key="question-{{ $question->id }}"
            @copy.prevent
            @cut.prevent
            @contextmenu.prevent
        >
            @if ($question->topic)
                <span class="quiz-topic-badge">{{ $question->topic }}</span>
            @endif
            <h3 class="quiz-question-text">{{ $question->question_text }}</h3>

            @if ($question->code_snippet)
                <pre class="quiz-code-snippet"><code>{{ $question->code_snippet }}</code></pre>
            @endif

            <div class="quiz-options">
                @foreach ($question->options as $option)
                    <button
                        type="button"
                        wire:click="selectOption({{ $question->id }}, {{ $option->id }})"
                        class="quiz-option {{ ($selectedOptions[$question->id] ?? null) == $option->id ? 'quiz-option-selected' : '' }}"
                    >
                        {{ $option->option_text }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="quiz-nav">
            <button type="button" wire:click="previousQuestion" @if ($currentIndex === 0) disabled @endif class="quiz-nav-button quiz-nav-secondary">
                Previous
            </button>

            @if ($currentIndex < $questions->count() - 1)
                <button type="button" wire:key="nav-next" wire:click="nextQuestion" class="quiz-nav-button quiz-nav-primary">
                    Next
                </button>
            @else
                <button type="button" wire:key="nav-submit" wire:click="submitExam" wire:confirm="Submit your test now? You won't be able to change your answers after this." class="quiz-nav-button quiz-nav-submit">
                    Submit Test
                </button>
            @endif
        </div>

        <div class="quiz-jump-list">
            @foreach ($questions as $index => $q)
                <button
                    type="button"
                    wire:click="goToQuestion({{ $index }})"
                    class="quiz-jump-item {{ $index === $currentIndex ? 'quiz-jump-active' : '' }} {{ isset($selectedOptions[$q->id]) ? 'quiz-jump-answered' : '' }}"
                >
                    {{ $index + 1 }}
                </button>
            @endforeach
        </div>
    @endif

    <style>
        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .quiz-progress {
            font-size: 14px;
            color: #666;
        }
        .quiz-answered-count {
            color: #999;
        }
        .quiz-timer {
            font-size: 20px;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
            color: #232323;
            background: #f2f2f2;
            padding: 6px 16px;
            border-radius: 8px;
        }
        .quiz-timer-warning {
            color: #fff;
            background: #e53935;
        }
        .quiz-progress-bar {
            height: 6px;
            background: #eee;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .quiz-progress-bar-fill {
            height: 100%;
            background: #2196f3;
            transition: width 0.3s ease;
        }
        .quiz-question-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 28px;
            margin-bottom: 20px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .quiz-topic-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #2196f3;
            background: #e3f2fd;
            border-radius: 20px;
            padding: 4px 12px;
            margin-bottom: 14px;
        }
        .quiz-question-text {
            font-size: 20px;
            line-height: 1.4;
            margin-bottom: 20px;
        }
        .quiz-code-snippet {
            background: #232323;
            color: #f2f2f2;
            padding: 16px;
            border-radius: 8px;
            overflow-x: auto;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .quiz-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .quiz-option {
            text-align: left;
            padding: 14px 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.15s ease;
        }
        .quiz-option:hover {
            border-color: #2196f3;
            background: #f5faff;
        }
        .quiz-option-selected {
            border-color: #2196f3;
            background: #e3f2fd;
            font-weight: 600;
        }
        .quiz-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .quiz-nav-button {
            padding: 11px 28px;
            border-radius: 6px;
            border: none;
            font-size: 15px;
            cursor: pointer;
        }
        .quiz-nav-button:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
        .quiz-nav-secondary {
            background: #f2f2f2;
            color: #232323;
        }
        .quiz-nav-primary {
            background: #2196f3;
            color: #fff;
        }
        .quiz-nav-submit {
            background: #25d366;
            color: #fff;
        }
        .quiz-jump-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .quiz-jump-item {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
            font-size: 13px;
        }
        .quiz-jump-active {
            border-color: #2196f3;
            background: #2196f3;
            color: #fff;
        }
        .quiz-jump-answered:not(.quiz-jump-active) {
            border-color: #25d366;
            color: #25d366;
        }
    </style>
</div>
