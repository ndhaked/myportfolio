<?php

use App\Models\Question;
use App\Models\QuizLevel;
use App\Models\QuizTechnology;
use Livewire\Volt\Component;

new class extends Component
{
    public ?Question $question = null;
    public ?int $quiz_technology_id = null;
    public ?int $quiz_level_id = null;
    public ?string $topic = null;
    public string $question_text = '';
    public ?string $code_snippet = null;
    public array $options = [
        ['text' => '', 'is_correct' => true],
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
    ];

    public function mount(?Question $question = null): void
    {
        if ($question && $question->exists) {
            $this->question = $question;
            $this->quiz_technology_id = $question->quiz_technology_id;
            $this->quiz_level_id = $question->quiz_level_id;
            $this->topic = $question->topic;
            $this->question_text = $question->question_text;
            $this->code_snippet = $question->code_snippet;
            $this->options = $question->options->map(fn ($option) => [
                'text' => $option->option_text,
                'is_correct' => $option->is_correct,
            ])->all();
        }
    }

    public function addOption(): void
    {
        if (count($this->options) < 6) {
            $this->options[] = ['text' => '', 'is_correct' => false];
        }
    }

    public function removeOption(int $index): void
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    public function markCorrect(int $index): void
    {
        foreach ($this->options as $i => $option) {
            $this->options[$i]['is_correct'] = $i === $index;
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'quiz_technology_id' => ['required', 'exists:quiz_technologies,id'],
            'quiz_level_id' => ['required', 'exists:quiz_levels,id'],
            'topic' => ['nullable', 'string', 'max:100'],
            'question_text' => ['required', 'string'],
            'code_snippet' => ['nullable', 'string'],
            'options' => ['required', 'array', 'min:2'],
            'options.*.text' => ['required', 'string'],
        ]);

        if (! collect($this->options)->contains('is_correct', true)) {
            $this->addError('options', 'Mark one option as the correct answer.');

            return;
        }

        $question = Question::updateOrCreate(
            ['id' => $this->question?->id],
            [
                'quiz_technology_id' => $validated['quiz_technology_id'],
                'quiz_level_id' => $validated['quiz_level_id'],
                'topic' => $validated['topic'],
                'question_text' => $validated['question_text'],
                'code_snippet' => $validated['code_snippet'],
                'status' => true,
            ]
        );

        $question->options()->delete();

        foreach ($this->options as $index => $option) {
            $question->options()->create([
                'option_text' => $option['text'],
                'is_correct' => (bool) $option['is_correct'],
                'sort_order' => $index,
            ]);
        }

        $this->redirect(route('admin.skill-test.questions.index'), navigate: false);
    }

    public function with(): array
    {
        return [
            'technologies' => QuizTechnology::where('status', true)->orderBy('name')->get(),
            'levels' => QuizLevel::where('status', true)->orderBy('duration_minutes')->get(),
        ];
    }
}; ?>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-2xl">
    <form wire:submit="save" class="space-y-5">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Technology</label>
                <select wire:model="quiz_technology_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select</option>
                    @foreach ($technologies as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                    @endforeach
                </select>
                @error('quiz_technology_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <select wire:model="quiz_level_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                @error('quiz_level_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Topic <span class="text-gray-400 font-normal">(optional, shown in result breakdown)</span></label>
            <input type="text" wire:model="topic" placeholder="e.g. Eloquent, Routing, Queues" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
            <textarea wire:model="question_text" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('question_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Code Snippet <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea wire:model="code_snippet" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm"></textarea>
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm font-medium text-gray-700">Options <span class="text-gray-400 font-normal">(select the correct one)</span></label>
                @if (count($options) < 6)
                    <button type="button" wire:click="addOption" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">+ Add option</button>
                @endif
            </div>

            <div class="space-y-2">
                @foreach ($options as $index => $option)
                    <div class="flex items-center gap-2" wire:key="option-{{ $index }}">
                        <input type="radio" wire:click="markCorrect({{ $index }})" @checked($option['is_correct']) class="text-indigo-600">
                        <input type="text" wire:model="options.{{ $index }}.text" placeholder="Option text" class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @if (count($options) > 2)
                            <button type="button" wire:click="removeOption({{ $index }})" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                        @endif
                    </div>
                @endforeach
            </div>
            @error('options') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                Save Question
            </button>
            <a href="{{ route('admin.skill-test.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg border border-gray-300 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</div>
