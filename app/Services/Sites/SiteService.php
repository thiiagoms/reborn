<?php

namespace App\Services\Sites;

use App\DTO\Site\SiteDTO;
use App\Enums\Settings\SettingsEnum;
use App\Models\Site\Site;
use App\Services\Service;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class SiteService extends Service
{
    /**
     * @return LengthAwarePaginator
     */
    public static function index(): LengthAwarePaginator
    {
        return Site::paginate(SettingsEnum::DEFAULT_MODEL_PAGINATE->value);
    }

    /**
     * @param SiteDTO $siteDTO
     * @return array
     */
    public static function store(SiteDTO $siteDTO): array
    {
        $siteDTO->name = self::removeTags($siteDTO->name);

        if (!is_null($siteDTO->description)) {
            $siteDTO->description = self::removeTags($siteDTO->description);
        }

        $siteDTO->user_id = self::getUserAuthId();

        $result = [];

        DB::transaction(function () use ($siteDTO, &$result) {

            $site = Site::create((array) $siteDTO);

            if ($site instanceof Site) {
                $result['message'] = "Site {$siteDTO->name} was created";
            }
        });

        return $result;
    }

    /**
     * @param SiteDTO $siteDTO
     * @param string $siteId
     * @return array
     */
    public static function update(SiteDTO $siteDTO, string $siteId): array
    {
        $siteDTO->name = self::removeTags($siteDTO->name);

        if (!is_null($siteDTO->description)) {
            $siteDTO->description = self::removeTags($siteDTO->description);
        }

        $siteDTO->user_id = self::getUserAuthId();

        $oldName = Site::find($siteId);

        $result = [];

        DB::transaction(function () use ($siteDTO, $siteId, $oldName, &$result) {

            $afftectedRows = Site::where('id', $siteId)->update((array) $siteDTO);

            if ($afftectedRows > 0) {
                $result['message'] = "Site {$oldName->name} was updated to {$siteDTO->name}";
            }
        });

        return $result;
    }

    /**
     * @param Site $site
     * @return array
     */
    public static function destroy(Site $site): array
    {
        $result = [];

        DB::transaction(function () use (&$result, $site) {

            $oldName = $site->name;

            $affetectedRows = Site::destroy($site->id);

            if ($affetectedRows > 0) {
                $result['message'] = "Site {$oldName} was deleted";
            }
        });

        return $result;
    }
}
