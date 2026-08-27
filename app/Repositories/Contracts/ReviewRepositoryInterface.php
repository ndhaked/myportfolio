<?php

namespace App\Repositories\Contracts;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface
{
    public function all(): Collection;

    public function active(): Collection;

    public function find(int $id): ?Review;

    public function create(array $data): Review;

    public function update(int $id, array $data): Review;

    public function delete(int $id): void;

    public function toggleActive(int $id): Review;
}
