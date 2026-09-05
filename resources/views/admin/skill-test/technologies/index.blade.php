<x-layouts.panel :title="'Skill Test Technologies'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Technologies</h1>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-lg mb-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Add a new technology</h2>
        <form method="POST" action="{{ route('admin.skill-test.technologies.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="name" placeholder="e.g. Vue.js" required class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">Add</button>
        </form>
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm divide-y divide-gray-100 max-w-lg">
        @foreach ($technologies as $technology)
            <div class="p-4 flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-900">{{ $technology->name }}</p>
                    <p class="text-xs text-gray-500">{{ $technology->questions_count }} question(s)</p>
                </div>
                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ route('admin.skill-test.technologies.update', $technology) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="name" value="{{ $technology->name }}">
                        <input type="hidden" name="status" value="{{ $technology->status ? 0 : 1 }}">
                        <button type="submit" class="text-sm font-medium {{ $technology->status ? 'text-emerald-700' : 'text-gray-400' }}">
                            {{ $technology->status ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.skill-test.technologies.destroy', $technology) }}" onsubmit="return confirm('Delete this technology and all its questions?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.panel>
