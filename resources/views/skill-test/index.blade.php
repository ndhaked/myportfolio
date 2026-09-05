@extends('layouts.quiz')

@section('title', 'Skill Eligibility Test')

@section('content')
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8">
        <h1 class="text-2xl font-semibold mb-2">Test Your Skills</h1>
        <p class="text-gray-500 mb-6">Pick a technology and level, enter your details, and get an instant score report.</p>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('skill-test.start') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Technology</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($technologies as $technology)
                        <label class="flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="quiz_technology_id" value="{{ $technology->id }}" {{ $loop->first ? 'checked' : '' }} required class="text-indigo-600">
                            <span class="text-sm">{{ $technology->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach ($levels as $level)
                        <label class="flex flex-col items-center text-center gap-1 border border-gray-300 rounded-lg px-3 py-3 cursor-pointer has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="quiz_level_id" value="{{ $level->id }}" {{ $loop->first ? 'checked' : '' }} required class="text-indigo-600">
                            <span class="text-sm font-medium">{{ $level->name }}</span>
                            @if ($level->target_audience)
                                <span class="text-xs text-gray-400">{{ $level->target_audience }}</span>
                            @endif
                            <span class="text-xs text-gray-500">{{ $level->question_count }} Qs / {{ $level->duration_minutes }} min</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <button type="submit" class="w-full py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                Start Test
            </button>
        </form>
    </div>
@endsection
