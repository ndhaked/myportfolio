<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Skill Test') - {{ config('app.name', 'Nirbhay Dhaked') }}</title>
        <meta name="robots" content="noindex, follow" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-3xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight">Nirbhay Dhaked</a>
                <span class="text-sm text-gray-500">Skill Eligibility Test</span>
            </div>
        </header>

        <main class="max-w-3xl mx-auto px-4 py-10">
            @yield('content')
        </main>

        @livewireScripts
    </body>
</html>
