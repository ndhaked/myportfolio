<?php

use App\Repositories\Contracts\ReviewRepositoryInterface;
use Livewire\Volt\Component;

new class extends Component
{
    public $reviews = [];

    public ?int $editingId = null;
    public ?string $client_name = null;
    public ?string $client_role = null;
    public ?string $quote = null;
    public ?string $youtube_input = null;
    public bool $is_active = true;

    public bool $showForm = false;

    protected ReviewRepositoryInterface $reviewRepository;

    public function boot(ReviewRepositoryInterface $reviewRepository): void
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function mount(): void
    {
        $this->refreshList();
    }

    protected function refreshList(): void
    {
        $this->reviews = $this->reviewRepository->all();
    }

    protected function rules(): array
    {
        return [
            'client_name' => 'nullable|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'quote' => 'nullable|string',
            'youtube_input' => 'nullable|string|max:255',
        ];
    }

    public static function extractYoutubeId(?string $input): ?string
    {
        if (! $input) {
            return null;
        }

        $input = trim($input);

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $input, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $review = $this->reviewRepository->find($id);

        if (! $review) {
            return;
        }

        $this->editingId = $review->id;
        $this->client_name = $review->client_name;
        $this->client_role = $review->client_role;
        $this->quote = $review->quote;
        $this->youtube_input = $review->youtube_video_id;
        $this->is_active = $review->is_active;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $data = [
            'client_name' => $validated['client_name'],
            'client_role' => $validated['client_role'],
            'quote' => $validated['quote'],
            'youtube_video_id' => static::extractYoutubeId($validated['youtube_input']),
            'is_active' => $this->is_active,
        ];

        if (empty($data['youtube_video_id']) && ! empty($validated['youtube_input'])) {
            $this->addError('youtube_input', 'Could not recognize that as a YouTube URL or video ID.');

            return;
        }

        if ($this->editingId) {
            $this->reviewRepository->update($this->editingId, $data);
        } else {
            $this->reviewRepository->create($data);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->refreshList();
    }

    public function delete(int $id): void
    {
        $this->reviewRepository->delete($id);
        $this->refreshList();
    }

    public function toggleActive(int $id): void
    {
        $this->reviewRepository->toggleActive($id);
        $this->refreshList();
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    protected function resetForm(): void
    {
        $this->reset(['editingId', 'client_name', 'client_role', 'quote', 'youtube_input', 'is_active']);
        $this->resetErrorBag();
    }
}; ?>

    <div class="space-y-6 max-w-4xl">
        <div class="flex justify-end">
            <button type="button" wire:click="create" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                Add Review
            </button>
        </div>

        @if ($showForm)
            <div class="fixed inset-0 z-40 flex items-center justify-center p-4" wire:key="review-modal">
                <div class="absolute inset-0 bg-black/40" wire:click="cancel"></div>

                <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">{{ $editingId ? 'Edit Review' : 'Add Review' }}</h2>

                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                            <input type="text" wire:model="client_name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('client_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role / Company</label>
                            <input type="text" wire:model="client_role" placeholder="CEO, Example Company" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('client_role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quote</label>
                            <textarea wire:model="quote" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('quote') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">YouTube Video URL or ID</label>
                            <input type="text" wire:model="youtube_input" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('youtube_input') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="is_active" class="text-sm font-medium text-gray-700">Active <span class="text-gray-400 font-normal">(shown on the front page)</span></label>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
                                Save
                            </button>
                            <button type="button" wire:click="cancel" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg border border-gray-300 hover:bg-gray-50">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm divide-y divide-gray-100">
            @forelse ($reviews as $item)
                <div class="p-4 flex items-center gap-4" wire:key="review-{{ $item->id }}">
                    @if ($item->youtube_video_id)
                        <img src="https://img.youtube.com/vi/{{ $item->youtube_video_id }}/default.jpg" class="h-14 w-20 rounded-lg object-cover border border-gray-200 shrink-0">
                    @else
                        <div class="h-14 w-20 rounded-lg bg-gray-100 shrink-0"></div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="font-semibold text-gray-900 truncate">{{ $item->client_name ?: '(untitled)' }}</p>
                            @if ($item->is_active)
                                <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 shrink-0">Active</span>
                            @else
                                <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 shrink-0">Inactive</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 truncate">{{ $item->client_role }}</p>
                        <p class="text-sm text-gray-400 truncate italic">{{ $item->quote }}</p>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        <button
                            type="button"
                            wire:click="toggleActive({{ $item->id }})"
                            title="{{ $item->is_active ? 'Deactivate' : 'Activate' }}"
                            class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $item->is_active ? 'bg-indigo-600' : 'bg-gray-300' }}"
                        >
                            <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform {{ $item->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                        </button>
                        <button type="button" wire:click="edit({{ $item->id }})" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</button>
                        <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Delete this review?" class="text-sm font-medium text-red-600 hover:text-red-800">Delete</button>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">No reviews yet. Click "Add Review" to create one.</div>
            @endforelse
        </div>
    </div>
