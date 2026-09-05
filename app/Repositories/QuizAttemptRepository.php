<?php

namespace App\Repositories;

use App\Models\QuizAttempt;
use App\Repositories\Contracts\QuizAttemptRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class QuizAttemptRepository implements QuizAttemptRepositoryInterface
{
    public function all(): Collection
    {
        return QuizAttempt::with(['technology', 'level'])->latest()->get();
    }

    public function find(int $id): ?QuizAttempt
    {
        return QuizAttempt::with(['technology', 'level'])->find($id);
    }

    public function create(array $data): QuizAttempt
    {
        return QuizAttempt::create($data);
    }

    public function update(int $id, array $data): QuizAttempt
    {
        $attempt = QuizAttempt::findOrFail($id);
        $attempt->update($data);

        return $attempt;
    }
}
