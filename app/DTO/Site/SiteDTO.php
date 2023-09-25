<?php

declare(strict_types=1);

namespace App\DTO\Site;

class SiteDTO
{
    /**
     * @param string $name
     * @param string|null $description
     * @param string|null $userId
     */
    public function __construct(
        public string $name,
        public string|null $description,
    ) {
    }
}
