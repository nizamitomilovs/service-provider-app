<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\ProviderIndexRequest;
use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use App\Repositories\Criteria\PageCriteria;
use App\Repositories\Criteria\ProviderFilterCriteria;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class ProviderService
{
    public function __construct(
        private ProviderRepositoryInterface $providerRepository,
    ) {
    }

    public function getPaginatedProviders(ProviderIndexRequest $request): LengthAwarePaginator
    {
        $filters = ProviderFilterCriteria::createEmpty();
        $filters = $filters->withCategoryId($request->category_id);

        $page = new PageCriteria(
            $request->page,
            $request->per_page,
        );

        return $this->providerRepository->findPaginatedWithFilters($filters, $page);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getProvider(string $id): Provider
    {
        return $this->providerRepository->findById($id);
    }
}
