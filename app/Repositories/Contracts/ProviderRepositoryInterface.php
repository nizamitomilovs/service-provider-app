<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Provider;
use App\Repositories\Criteria\PageCriteria;
use App\Repositories\Criteria\ProviderFilterCriteria;
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
