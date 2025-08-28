<?php

declare(strict_types=1);

namespace App\Services;

use App\Filters\PageCriteria;
use App\Filters\ProviderFilterCriteria;
use App\Http\Requests\ProviderIndexRequest;
use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
