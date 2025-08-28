<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Filters\PageCriteria;
use App\Filters\ProviderFilterCriteria;
use App\Models\Provider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProviderRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<int, Provider>
     */
    public function findPaginatedWithFilters(ProviderFilterCriteria $criteria, PageCriteria $page): LengthAwarePaginator;

    /**
     * @throws ModelNotFoundException
     */
    public function findById(string $id): Provider;
}
