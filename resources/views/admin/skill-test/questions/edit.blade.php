<x-layouts.panel :title="'Edit Question'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Edit Question</h1>
    </x-slot>

    <livewire:admin.quiz-question-form :question="$question" />
</x-layouts.panel>
