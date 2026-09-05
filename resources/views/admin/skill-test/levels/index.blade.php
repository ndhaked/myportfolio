<x-layouts.panel :title="'Skill Test Levels'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Levels</h1>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-sm">{{ session('success') }}</div>
    @endif

    <div class="space-y-4 max-w-2xl">
        @foreach ($levels as $level)
            <form method="POST" action="{{ route('admin.skill-test.levels.update', $level) }}" class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Name</label>
                        <input type="text" name="name" value="{{ $level->name }}" class="w-full rounded-lg border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Target Audience</label>
                        <input type="text" name="target_audience" value="{{ $level->target_audience }}" class="w-full rounded-lg border-gray-300 shadow-sm text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Questions</label>
                        <input type="number" name="question_count" value="{{ $level->question_count }}" class="w-full rounded-lg border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Duration (min)</label>
                        <input type="number" name="duration_minutes" value="{{ $level->duration_minutes }}" class="w-full rounded-lg border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Pass %</label>
                        <input type="number" name="pass_percentage" value="{{ $level->pass_percentage }}" class="w-full rounded-lg border-gray-300 shadow-sm text-sm">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="status" value="1" @checked($level->status)> Active
                    </label>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">Save</button>
                </div>
            </form>
        @endforeach
    </div>
</x-layouts.panel>
