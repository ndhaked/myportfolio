<?php

use App\Models\Portfolio;
use App\Repositories\Contracts\PortfolioRepositoryInterface;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $portfolios = [];

    public ?int $editingId = null;
    public ?string $title = null;
    public ?string $description = null;
    public string $technologiesInput = '';
    public ?string $category = null;
    public $photo = null;
    public ?string $existingPhoto = null;
    public $detailPhoto = null;
    public ?string $existingDetailPhoto = null;
    public ?string $website_url = null;

    public bool $showForm = false;

    protected PortfolioRepositoryInterface $portfolioRepository;

    public function boot(PortfolioRepositoryInterface $portfolioRepository): void
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function mount(): void
    {
        $this->refreshList();
    }

    public function categories(): array
    {
        return Portfolio::CATEGORIES;
    }

    protected function refreshList(): void
    {
        $this->portfolios = $this->portfolioRepository->all();
    }

    protected function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'technologiesInput' => 'nullable|string',
            'category' => 'nullable|in:'.implode(',', Portfolio::CATEGORIES),
            'photo' => 'nullable|image|max:2048',
            'detailPhoto' => 'nullable|image|max:2048',
            'website_url' => 'nullable|url|max:255',
        ];
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $portfolio = $this->portfolioRepository->find($id);

        if (! $portfolio) {
            return;
        }

        $this->editingId = $portfolio->id;
        $this->title = $portfolio->title;
        $this->description = $portfolio->description;
        $this->technologiesInput = implode(', ', $portfolio->technologies ?? []);
        $this->category = $portfolio->category;
        $this->existingPhoto = $portfolio->photo;
        $this->existingDetailPhoto = $portfolio->detail_photo;
        $this->website_url = $portfolio->website_url;
        $this->photo = null;
        $this->detailPhoto = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $technologies = collect(explode(',', $validated['technologiesInput'] ?? ''))
            ->map(fn ($tech) => trim($tech))
            ->filter()
            ->values()
            ->all();

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'technologies' => $technologies,
            'category' => $validated['category'],
            'website_url' => $validated['website_url'],
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('portfolio', 'public');
        }

        if ($this->detailPhoto) {
            $data['detail_photo'] = $this->detailPhoto->store('portfolio', 'public');
        }

        if ($this->editingId) {
            $this->portfolioRepository->update($this->editingId, $data);
        } else {
            $data['photo'] = $data['photo'] ?? null;
            $data['detail_photo'] = $data['detail_photo'] ?? null;
            $this->portfolioRepository->create($data);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->refreshList();
    }

    public function delete(int $id): void
    {
        $this->portfolioRepository->delete($id);
        $this->refreshList();
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    protected function resetForm(): void
    {
        $this->reset(['editingId', 'title', 'description', 'technologiesInput', 'category', 'photo', 'existingPhoto', 'detailPhoto', 'existingDetailPhoto', 'website_url']);
        $this->resetErrorBag();
    }
}; ?>

<div class="space-y-6 max-w-4xl">
    <div class="flex justify-end">
        <button type="button" wire:click="create" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">
            Add Project
        </button>
    </div>

    @if ($showForm)
        <div class="fixed inset-0 z-40 flex items-center justify-center p-4" wire:key="portfolio-modal">
            <div class="absolute inset-0 bg-black/40" wire:click="cancel"></div>

            <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">{{ $editingId ? 'Edit Project' : 'Add Project' }}</h2>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" wire:model="title" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select wire:model="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a category</option>
                            @foreach ($this->categories() as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Technologies <span class="text-gray-400 font-normal">(comma-separated)</span></label>
                        <input type="text" wire:model="technologiesInput" placeholder="Laravel, Vue.js, MySQL" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('technologiesInput') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                        <input type="text" wire:model="website_url" placeholder="https://example.com" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('website_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Photo <span class="text-gray-400 font-normal">(shown in the grid)</span></label>
                        @if ($existingPhoto && ! $photo)
                            <img src="{{ asset('storage/'.$existingPhoto) }}" class="h-20 w-auto rounded-lg border border-gray-200 mb-2">
                        @endif
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="h-20 w-auto rounded-lg border border-gray-200 mb-2">
                        @endif
                        <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-gray-600">
                        <div wire:loading wire:target="photo" class="text-xs text-gray-400 mt-1">Uploading...</div>
                        @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Detail Photo <span class="text-gray-400 font-normal">(shown in the "view details" popup)</span></label>
                        @if ($existingDetailPhoto && ! $detailPhoto)
                            <img src="{{ asset('storage/'.$existingDetailPhoto) }}" class="h-20 w-auto rounded-lg border border-gray-200 mb-2">
                        @endif
                        @if ($detailPhoto)
                            <img src="{{ $detailPhoto->temporaryUrl() }}" class="h-20 w-auto rounded-lg border border-gray-200 mb-2">
                        @endif
                        <input type="file" wire:model="detailPhoto" accept="image/*" class="block w-full text-sm text-gray-600">
                        <div wire:loading wire:target="detailPhoto" class="text-xs text-gray-400 mt-1">Uploading...</div>
                        @error('detailPhoto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
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
        @forelse ($portfolios as $item)
            <div class="p-4 flex items-center gap-4" wire:key="portfolio-{{ $item->id }}">
                @if ($item->photo)
                    <img src="{{ asset('storage/'.$item->photo) }}" class="h-14 w-14 rounded-lg object-cover border border-gray-200 shrink-0">
                @else
                    <div class="h-14 w-14 rounded-lg bg-gray-100 shrink-0"></div>
                @endif

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="font-semibold text-gray-900 truncate">{{ $item->title ?: '(untitled)' }}</p>
                        @if ($item->category)
                            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 shrink-0">{{ $item->category }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 truncate">{{ $item->description }}</p>
                    @if (! empty($item->technologies))
                        <div class="mt-1 flex flex-wrap gap-1">
                            @foreach ($item->technologies as $tech)
                                <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" wire:click="edit({{ $item->id }})" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</button>
                    <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Delete this project?" class="text-sm font-medium text-red-600 hover:text-red-800">Delete</button>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500 text-sm">No projects yet. Click "Add Project" to create one.</div>
        @endforelse
    </div>
</div>
