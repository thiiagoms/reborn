<?php

declare(strict_types=1);

namespace App\DTO\Endpoints;

class EndpointDTO
{
    /**
     * @param string $name
     * @param integer $http
     * @param integer $frequency
     * @param integer $frequency_interval
     * @param string|null $payload
     * @param string $siteUuid
     */
    public function __construct(
        public string $name,
        public readonly int $http,
        public readonly int $frequency,
        public readonly int $frequency_interval,
        public string|null $payload,
        public readonly string|null $site_id = null,
        public string|null $id = null
    ) {
    }
}
