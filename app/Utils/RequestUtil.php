<?php

declare(strict_types=1);

namespace App\Utils;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class RequestUtil
{
    /**
     * @param string $endpoint
     * @param array $payload
     * @return Response
     */
    public static function get(string $endpoint, array $payload = []): Response
    {
        return Http::get($endpoint, $payload);
    }

    public static function post()
    {
    }

    public static function delete()
    {
    }
}
