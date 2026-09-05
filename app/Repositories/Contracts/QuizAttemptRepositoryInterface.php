<?php

namespace App\Repositories\Contracts;

use App\Models\QuizAttempt;
use Illuminate\Database\Eloquent\Collection;

interface QuizAttemptRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): ?QuizAttempt;

    public function create(array $data): QuizAttempt;

    public function update(int $id, array $data): QuizAttempt;
}
