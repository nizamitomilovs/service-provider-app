<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function findAll(): Collection
    {
        return Category::query()->get();
    }
}
