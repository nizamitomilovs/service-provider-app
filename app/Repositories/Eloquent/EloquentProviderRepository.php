<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Filters\PageCriteria;
use App\Filters\ProviderFilterCriteria;
use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

final class EloquentProviderRepository implements ProviderRepositoryInterface
{
    public function findPaginatedWithFilters(ProviderFilterCriteria $criteria, PageCriteria $page): LengthAwarePaginator
    {
        $query = Provider::query()->with('category');

        $this->applyFilters($criteria, $query);

        return $query->paginate(
            perPage: $page->limit,
            page: $page->page,
        );
    }

    public function findById(string $id): Provider
    {
        return Provider::query()
            ->with('category')
            ->where('id', $id)
            ->firstOrFail();
    }

    private function applyFilters(ProviderFilterCriteria $criteria, Builder $query): void
    {
        if (null !== $criteria->categoryId) {
            $query->where('category_id', $criteria->categoryId);
        }
    }
}
