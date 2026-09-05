<x-layouts.panel :title="'Attempt Detail'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">{{ $attempt->name }}'s Attempt</h1>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                <div><p class="text-gray-500">Email</p><p class="font-medium">{{ $attempt->email }}</p></div>
                <div><p class="text-gray-500">Phone</p><p class="font-medium">{{ $attempt->phone }}</p></div>
                <div><p class="text-gray-500">Technology</p><p class="font-medium">{{ $attempt->technology->name }}</p></div>
                <div><p class="text-gray-500">Level</p><p class="font-medium">{{ $attempt->level->name }}</p></div>
                <div>
                    <p class="text-gray-500">Status</p>
                    <p class="font-medium capitalize">
                        {{ str_replace('_', ' ', $attempt->status) }}
                        @if ($attempt->termination_reason === 'tab_switch')
                            <span class="text-red-600 text-xs font-semibold">(⚠ left tab)</span>
                        @endif
                    </p>
                </div>
                <div><p class="text-gray-500">Score</p><p class="font-medium">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }} ({{ $attempt->score_percentage }}%)</p></div>
                <div><p class="text-gray-500">Started</p><p class="font-medium">{{ $attempt->started_at->format('d M Y, h:i A') }}</p></div>
                <div><p class="text-gray-500">Submitted</p><p class="font-medium">{{ $attempt->submitted_at?->format('d M Y, h:i A') ?? '—' }}</p></div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm divide-y divide-gray-100">
            @foreach ($attempt->answers as $answer)
                <div class="p-4">
                    <p class="font-medium text-gray-900 mb-2">{{ $loop->iteration }}. {{ $answer->question->question_text }}</p>
                    <div class="space-y-1 text-sm">
                        @foreach ($answer->question->options as $option)
                            <p class="{{ $option->is_correct ? 'text-emerald-700 font-medium' : ($option->id === $answer->selected_option_id ? 'text-red-600' : 'text-gray-500') }}">
                                {{ $option->option_text }}
                                @if ($option->is_correct) (Correct) @endif
                                @if ($option->id === $answer->selected_option_id && ! $option->is_correct) (Selected) @endif
                            </p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.panel>
