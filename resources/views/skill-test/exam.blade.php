@extends('layouts.quiz')

@section('title', 'Skill Test In Progress')

@section('content')
    <livewire:quiz.exam-runner :attempt="$attempt" />

    <script>
        // Deter leaving the exam via the browser back button. This is a UX
        // deterrent only — the server-side status/expiry checks in
        // QuizController@exam are the actual enforcement.
        history.pushState(null, '', location.href);
        window.addEventListener('popstate', function () {
            history.pushState(null, '', location.href);
        });
    </script>
@endsection
