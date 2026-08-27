<?php

namespace App\Repositories;

use App\Models\Portfolio;
use App\Repositories\Contracts\PortfolioRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PortfolioRepository implements PortfolioRepositoryInterface
{
    public function all(): Collection
    {
        return Portfolio::latest()->get();
    }

    public function find(int $id): ?Portfolio
    {
        return Portfolio::find($id);
    }

    public function create(array $data): Portfolio
    {
        return Portfolio::create($data);
    }

    public function update(int $id, array $data): Portfolio
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->update($data);

        return $portfolio;
    }

    public function delete(int $id): void
    {
        Portfolio::findOrFail($id)->delete();
    }
}
