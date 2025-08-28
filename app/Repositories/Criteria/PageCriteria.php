<?php

declare(strict_types=1);

namespace App\Repositories\Criteria;

final readonly class PageCriteria
{
    public function __construct(
        public int $page,
        public int $limit,
    ) {
    }
}
