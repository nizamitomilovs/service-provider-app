<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class CategoryService
{
    private const string CACHE_KEY          = 'categories:all';
    private const int    CACHE_TTL_IN_HOURS = 6;

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function getAllCategoriesCached(): Collection
    {
        return Cache::remember(
            self::CACHE_KEY,
            now()->addHours(self::CACHE_TTL_IN_HOURS),
            fn() => $this->categoryRepository->findAll()
        );
    }
}
