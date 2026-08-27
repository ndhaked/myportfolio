<x-layouts.panel :title="'Dashboard'">
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-gray-900">Dashboard</h1>
    </x-slot>

    <div class="space-y-6">
        <livewire:admin.dashboard-stats />

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <p class="text-gray-600">Welcome back, <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>. Use the sidebar to manage your portfolio.</p>
        </div>
    </div>
</x-layouts.panel>
