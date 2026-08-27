<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all(): Collection
    {
        return Review::orderBy('sort_order')->orderBy('id')->get();
    }

    public function active(): Collection
    {
        return Review::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
    }

    public function find(int $id): ?Review
    {
        return Review::find($id);
    }

    public function create(array $data): Review
    {
        return Review::create($data);
    }

    public function update(int $id, array $data): Review
    {
        $review = Review::findOrFail($id);
        $review->update($data);

        return $review;
    }

    public function delete(int $id): void
    {
        Review::findOrFail($id)->delete();
    }

    public function toggleActive(int $id): Review
    {
        $review = Review::findOrFail($id);
        $review->update(['is_active' => ! $review->is_active]);

        return $review;
    }
}
