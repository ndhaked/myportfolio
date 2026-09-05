<?php

use App\Repositories\Contracts\QuizAttemptRepositoryInterface;
use Livewire\Volt\Component;

new class extends Component
{
    public $attempts = [];

    public function boot(QuizAttemptRepositoryInterface $repository): void
    {
        $this->attempts = $repository->all();
    }

    public function refreshAttempts(): void
    {
        $this->attempts = app(QuizAttemptRepositoryInterface::class)->all();
    }
}; ?>

<div wire:poll.10s="refreshAttempts">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Candidate</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Technology / Level</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Score</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Started</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($attempts as $attempt)
                        <tr wire:key="attempt-{{ $attempt->id }}">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $attempt->name }}</p>
                                <p class="text-xs text-gray-500">{{ $attempt->email }} · {{ $attempt->phone }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $attempt->technology->name }} — {{ $attempt->level->name }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                Q{{ $attempt->current_question_index + 1 }} / {{ $attempt->total_questions }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($attempt->status === 'in_progress')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> In Progress
                                    </span>
                                @elseif ($attempt->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">Completed</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Timed Out</span>
                                @endif
                                @if ($attempt->termination_reason === 'tab_switch')
                                    <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700" title="Test was auto-submitted because the candidate switched tabs/windows">
                                        ⚠ Left Tab
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @if ($attempt->status !== 'in_progress')
                                    {{ $attempt->score_percentage }}%
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-gray-500 text-xs">{{ $attempt->started_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.skill-test.attempts.show', $attempt) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">No test attempts yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
