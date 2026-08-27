<?php

use App\Repositories\Contracts\PortfolioRepositoryInterface;
use Livewire\Volt\Component;

new class extends Component
{
    public int $total = 0;
    public int $webApplications = 0;
    public int $apps = 0;
    public int $withWebsite = 0;

    public function boot(PortfolioRepositoryInterface $portfolioRepository): void
    {
        $projects = $portfolioRepository->all();

        $this->total = $projects->count();
        $this->webApplications = $projects->where('category', 'Web Applications')->count();
        $this->apps = $projects->where('category', 'Apps')->count();
        $this->withWebsite = $projects->whereNotNull('website_url')->where('website_url', '!=', '')->count();
    }
}; ?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
        <div class="h-11 w-11 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
            <x-icon name="building" class="w-5 h-5" />
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Projects</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $total }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
        <div class="h-11 w-11 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <x-icon name="book" class="w-5 h-5" />
        </div>
        <div>
            <p class="text-sm text-gray-500">Web Applications</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $webApplications }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
        <div class="h-11 w-11 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
            <x-icon name="clipboard" class="w-5 h-5" />
        </div>
        <div>
            <p class="text-sm text-gray-500">Apps</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $apps }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex items-center gap-4">
        <div class="h-11 w-11 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
            <x-icon name="chart" class="w-5 h-5" />
        </div>
        <div>
            <p class="text-sm text-gray-500">With Live Website</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $withWebsite }}</p>
        </div>
    </div>
</div>
