@extends('layouts.quiz')

@section('title', 'Your Test Result')

@section('content')
    @php $passed = $attempt->score_percentage >= $attempt->level->pass_percentage; @endphp

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8 text-center">
        <span class="inline-block text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full {{ $passed ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">
            {{ $passed ? 'Passed' : 'Not Passed' }}
        </span>

        <h1 class="text-3xl font-bold mt-4">{{ $attempt->score_percentage }}%</h1>
        <p class="text-gray-500 mt-1">{{ $attempt->correct_answers }} correct out of {{ $attempt->total_questions }} questions</p>
        <p class="text-sm text-gray-400 mt-1">{{ $attempt->technology->name }} — {{ $attempt->level->name }} Level</p>

        @if ($topicBreakdown->isNotEmpty())
            <div class="mt-8 text-left">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Breakdown by Topic</h2>
                <div class="space-y-2">
                    @foreach ($topicBreakdown as $topic => $stats)
                        <div class="flex items-center justify-between border border-gray-100 rounded-lg px-4 py-2">
                            <span class="text-sm text-gray-700">{{ $topic }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $stats['correct'] }} / {{ $stats['total'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="text-gray-600 mb-4">Want to hire a Senior Laravel Architect to lead your team?</p>
            <a href="https://wa.me/918209990511?text={{ urlencode('Hi Nirbhay, I just took your skill test and scored '.$attempt->score_percentage.'%. I would like to discuss a project.') }}" target="_blank" rel="noopener" class="inline-block px-6 py-3 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600">
                Book a Call on WhatsApp
            </a>
        </div>
    </div>

    <p class="text-center text-sm text-gray-400 mt-6">
        <a href="{{ route('skill-test.index') }}" class="underline">Take another test</a>
    </p>
@endsection
