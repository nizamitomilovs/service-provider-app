<?php

declare(strict_types=1);

namespace App\Filters;

final readonly class ProviderFilterCriteria
{
    private function __construct(
        public ?string $categoryId = null,
    ) {
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public function withCategoryId(?string $categoryId): self
    {
        return new self(
            categoryId: $categoryId,
        );
    }
}
