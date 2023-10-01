<?php

declare(strict_types=1);

namespace App\Services\Endpoints;

use App\DTO\Check\CheckDTO;
use App\DTO\Endpoints\EndpointDTO;
use App\Enums\Frequency\FrequencyEnum;
use App\Enums\HTTP\HTTPEnum;
use App\Enums\Settings\SettingsEnum;
use App\Models\Endpoints\Endpoint;
use App\Services\Check\CheckService;
use App\Services\Service;
use App\Utils\DateUtil;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class EndpointService extends Service
{
    /**
     * @param string $siteId
     * @return LengthAwarePaginator
     */
    public static function index(string $siteId): LengthAwarePaginator
    {
        return tap(Endpoint::with('sites')
            ->where('site_id', $siteId)
            ->paginate(SettingsEnum::DEFAULT_MODEL_PAGINATE->value))->map(function (Endpoint $endpoint): void {
                $endpoint->http = HTTPEnum::getHTTPMethod($endpoint->http)->name;
                $endpoint->frequency_interval = FrequencyEnum::getFrequency($endpoint->frequency_interval)->name;
                $endpoint->payload = is_null($endpoint->payload);
            });
    }

    /**
     * @param string $endpointUuid
     * @return mixed
     */
    public static function show(string $endpointUuid): Endpoint
    {
        return Endpoint::find($endpointUuid);
    }

    /**
     * @return array
     */
    public static function create(): array
    {
        return [
            'http'        => HTTPEnum::getAllHTTPMethods(),
            'frequencies' => FrequencyEnum::getAllFrequencies()
        ];
    }

    /**
     * @param EndpointDTO $endpointDTO
     * @return array
     */
    public static function store(EndpointDTO $endpointDTO): array
    {
        $result = [];

        DB::transaction(function () use ($endpointDTO, &$result): void {

            $endpoint = Endpoint::create((array) $endpointDTO);

            if ($endpoint instanceof Endpoint) {
                $nextCheck = DateUtil::getDateDiff($endpoint->frequency, $endpoint->frequency_interval);

                CheckService::store($endpoint->id, $endpoint->site_id, $nextCheck);

                $result['message'] = "Endpoint {$endpointDTO->name} was created";
            }
        });

        return $result;
    }

    /**
     * @param string $endpointUuid
     * @return array
     */
    public static function edit(Endpoint $endpoint): array
    {
        $endpoint = [
            'name'        => $endpoint->name,
            'http'        => HTTPEnum::getAllHTTPMethods(),
            'frequencies' => FrequencyEnum::getAllFrequencies()
        ];

        return $endpoint;
    }

    /**
     * @param EndpointDTO $endpointDTO
     * @return array
     */
    public static function update(EndpointDTO $endpointDTO): array
    {
        $endpointDTO->name = self::removeTags($endpointDTO->name);

        $oldName = self::show($endpointDTO->id);

        $result = [];

        DB::transaction(function () use ($endpointDTO, &$result, $oldName) {

            $affetectedRows = Endpoint::where('id', $endpointDTO->id)->update((array) $endpointDTO);

            if ($affetectedRows > 0) {
                $result['message'] = "Endpoint {$oldName->name} was updated to {$endpointDTO->name}";
            }
        });

        return $result;
    }

    /**
     * @param string $endpointUuid
     * @return array
     */
    public static function destroy(string $endpointUuid): array
    {
        $oldName = self::show($endpointUuid);

        $result = [];

        DB::transaction(function () use (&$result, $oldName, $endpointUuid): void {

            $affetectedRows = Endpoint::destroy($endpointUuid);

            if ($affetectedRows > 0) {
                $result['message'] = "Endpoint {$oldName->name} was deleted";
            }
        });

        return $result;
    }
}
