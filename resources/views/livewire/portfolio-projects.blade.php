<?php

use App\Models\Portfolio;
use App\Repositories\Contracts\PortfolioRepositoryInterface;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new class extends Component
{
    public $projects = [];
    public string $activeFilter = 'All Projects';

    public function boot(PortfolioRepositoryInterface $portfolioRepository): void
    {
        $this->projects = $portfolioRepository->all();
    }

    public function categories(): array
    {
        return Portfolio::CATEGORIES;
    }

    public function setFilter(string $filter): void
    {
        $this->activeFilter = $filter;
    }

    public function countFor(string $filter): int
    {
        if ($filter === 'All Projects') {
            return $this->projects->count();
        }

        return $this->projects->where('category', $filter)->count();
    }

    #[Computed]
    public function filteredProjects()
    {
        if ($this->activeFilter === 'All Projects') {
            return $this->projects;
        }

        return $this->projects->where('category', $this->activeFilter)->values();
    }
}; ?>

<div class="wb-grid" x-data="{ lightboxOpen: false, lightboxSrc: '', lightboxTitle: '' }">
    <div class="wb-center">
        <div class="grid">
            <div class="cbp-l-filters-button">
                <div class="cbp-filter-item{{ $activeFilter === 'All Projects' ? ' cbp-filter-item-active' : '' }}" wire:click="setFilter('All Projects')">
                    All Projects
                    <div class="cbp-filter-counter">{{ $this->countFor('All Projects') }}</div>
                </div>
                @foreach ($this->categories() as $category)
                    <div class="cbp-filter-item{{ $activeFilter === $category ? ' cbp-filter-item-active' : '' }}" wire:click="setFilter('{{ $category }}')">
                        {{ $category }}
                        <div class="cbp-filter-counter">{{ $this->countFor($category) }}</div>
                    </div>
                @endforeach
            </div>
            <div class="row portfolio-grid">
                @forelse ($this->filteredProjects as $project)
                    @php
                        $thumb = $project->photo ? asset('storage/'.$project->photo) : asset('images/web/small/1-small.jpg');
                        $detail = $project->detail_photo ? asset('storage/'.$project->detail_photo) : $thumb;
                    @endphp
                    <div class="col-sm-4 portfolio-grid-item" wire:key="portfolio-{{ $project->id }}">
                        <div class="cbp-caption">
                            <div class="cbp-caption-defaultWrap">
                                <img src="{{ $thumb }}" alt="{{ $project->title }}">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <a href="#" @click.prevent="lightboxSrc = '{{ $detail }}'; lightboxTitle = '{{ addslashes($project->title ?: 'Untitled Project') }}'; lightboxOpen = true" class="cbp-l-caption-buttonRight">view details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cbp-l-grid-projects-title">
                            @if ($project->website_url)
                                <a href="{{ $project->website_url }}" target="_blank" rel="noopener">{{ $project->title ?: 'Untitled Project' }}</a>
                            @else
                                {{ $project->title ?: 'Untitled Project' }}
                            @endif
                        </div>
                        <div class="cbp-l-grid-projects-desc">{{ implode(' / ', $project->technologies ?? []) }}</div>
                    </div>
                @empty
                    <p class="text-center" style="width: 100%;">No projects in this category yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div
        x-show="lightboxOpen"
        x-cloak
        @click="lightboxOpen = false"
        @keydown.escape.window="lightboxOpen = false"
        class="portfolio-lightbox"
    >
        <span class="portfolio-lightbox-close" @click="lightboxOpen = false">&times;</span>
        <div class="portfolio-lightbox-inner" @click.stop>
            <img :src="lightboxSrc" :alt="lightboxTitle">
            <p x-text="lightboxTitle"></p>
        </div>
    </div>

    <style>
        .portfolio-grid {
            margin-top: 20px;
        }
        .portfolio-grid-item {
            margin-bottom: 30px;
        }
        .portfolio-grid-item .cbp-caption {
            position: relative;
            display: block;
            overflow: hidden;
        }
        .portfolio-grid-item .cbp-caption-defaultWrap {
            aspect-ratio: 4 / 3;
            overflow: hidden;
        }
        .portfolio-grid-item .cbp-caption-defaultWrap img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: fill;
        }
        .portfolio-grid-item .cbp-caption-activeWrap {
            position: absolute;
            inset: 0;
            background-color: rgba(20, 20, 20, 0.6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .portfolio-grid-item .cbp-caption:hover .cbp-caption-activeWrap {
            opacity: 1;
        }
        .portfolio-grid-item .cbp-l-caption-buttonRight,
        .portfolio-grid-item .cbp-l-caption-buttonRight:hover,
        .portfolio-grid-item .cbp-l-caption-buttonRight:focus {
            text-decoration: none;
        }
        .cbp-l-filters-button .cbp-filter-item {
            cursor: pointer;
        }
        .portfolio-lightbox {
            position: fixed;
            inset: 0;
            z-index: 10050;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .portfolio-lightbox-inner {
            max-width: 90vw;
            max-height: 85vh;
            text-align: center;
        }
        .portfolio-lightbox-inner img {
            max-width: 100%;
            max-height: 75vh;
            border-radius: 6px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }
        .portfolio-lightbox-inner p {
            color: #fff;
            margin-top: 14px;
            font-size: 15px;
        }
        .portfolio-lightbox-close {
            position: fixed;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 36px;
            line-height: 1;
            cursor: pointer;
            z-index: 10051;
        }
    </style>
</div>
