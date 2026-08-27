<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'SkoolMS') }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">

            <!-- Sidebar -->
            <aside
                class="print:hidden fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            >
                <div class="h-16 flex items-center gap-2.5 px-6 border-b border-gray-200 shrink-0">
                    <x-logo-mark class="h-11 w-11" />
                    <span class="text-base font-semibold tracking-tight text-gray-900 leading-tight">{{ config('app.name') }}</span>
                </div>

                <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 text-sm">
                    <x-panel.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <x-slot name="icon"><x-icon name="home" class="w-5 h-5" /></x-slot>
                        Dashboard
                    </x-panel.nav-link>
                    <x-panel.nav-link :href="route('admin.portfolio')" :active="request()->routeIs('admin.portfolio')">
                        <x-slot name="icon"><x-icon name="building" class="w-5 h-5" /></x-slot>
                        My Portfolio
                    </x-panel.nav-link>
                    <x-panel.nav-link :href="route('admin.reviews')" :active="request()->routeIs('admin.reviews')">
                        <x-slot name="icon"><x-icon name="chart" class="w-5 h-5" /></x-slot>
                        Reviews
                    </x-panel.nav-link>
                </nav>
            </aside>

            <!-- Overlay for mobile -->
            <div
                x-show="sidebarOpen"
                x-cloak
                @click="sidebarOpen = false"
                class="fixed inset-0 z-20 bg-black/30 lg:hidden"
            ></div>

            <!-- Main column -->
            <div class="flex-1 flex flex-col min-w-0 lg:pl-0">
                <!-- Topbar -->
                <header class="print:hidden h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-10">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <livewire:layout.panel-topbar />
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-4 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
