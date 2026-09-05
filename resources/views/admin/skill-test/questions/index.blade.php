<x-layouts.panel :title="'Question Bank'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Question Bank</h1>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <select name="technology" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-sm">
                <option value="">All Technologies</option>
                @foreach ($technologies as $tech)
                    <option value="{{ $tech->id }}" @selected(request('technology') == $tech->id)>{{ $tech->name }}</option>
                @endforeach
            </select>
            <select name="level" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-sm">
                <option value="">All Levels</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}" @selected(request('level') == $level->id)>{{ $level->name }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.skill-test.questions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
            Add Question
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm divide-y divide-gray-100">
        @forelse ($questions as $question)
            <div class="p-4 flex items-center justify-between gap-4">
                <div class="min-w-0">
                    <p class="font-medium text-gray-900 truncate">{{ $question->question_text }}</p>
                    <p class="text-xs text-gray-500">{{ $question->technology->name }} · {{ $question->level->name }} @if ($question->topic) · {{ $question->topic }} @endif</p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('admin.skill-test.questions.edit', $question) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                    <form method="POST" action="{{ route('admin.skill-test.questions.destroy', $question) }}" onsubmit="return confirm('Delete this question?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500 text-sm">No questions yet.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $questions->links() }}</div>
</x-layouts.panel>
