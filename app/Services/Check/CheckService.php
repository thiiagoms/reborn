<?php

declare(strict_types=1);

namespace App\Services\Check;

use App\DTO\Check\CheckDTO;
use App\Models\Check\Check;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Check Service
 *
 * @package App\Services\Check
 * @author Thiago <thiiagoms@proton.me>
 * @version 1.0
 */
final class CheckService extends Service
{
    /**
     * @param string $endpointId
     * @return Check|null
     */
    public static function show(string $endpointId): Check|null
    {
        return Check::where('endpoint_id', $endpointId)->first();
    }

    /**
     * @param string $endpointId
     * @param string $siteId
     * @param Carbon $nextCheckDate
     * @return void
     */
    public static function store(string $endpointId, string $siteId, Carbon $nextCheckDate): void
    {
        DB::transaction(function () use ($siteId, $endpointId, $nextCheckDate): void {
            Check::create([
                'site_id'     => $siteId,
                'endpoint_id' => $endpointId,
                'next_check'  => $nextCheckDate
            ]);
        });
    }

    /**
     * @param string $checkId
     * @param array $params
     * @return void
     */
    public static function update(string $checkId, array $params): void
    {
        DB::transaction(function () use ($checkId, $params): void {
            Check::where('id', $checkId)->update($params);
        });
    }
}
