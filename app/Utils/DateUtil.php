<?php

declare(strict_types=1);

namespace App\Utils;

use App\Enums\Frequency\FrequencyEnum;
use Carbon\Carbon;

final class DateUtil
{
    /**
     * @param integer $frequency
     * @param integer $frequencyInterval
     * @return Carbon
     */
    public static function getDateDiff(int $frequency, int $frequencyInterval): Carbon
    {
        $currentDate = Carbon::now();

        $frequencyInterval = FrequencyEnum::getFrequency($frequencyInterval);

        match ($frequencyInterval->name) {
            'MINUTES' => $currentDate->addMinutes($frequency),
            'HOURS'   => $currentDate->addHours($frequency),
            'DAYS'    => $currentDate->addDays($frequency),
            'WEEKS'   => $currentDate->addWeeks($frequency),
            'MONTHS'  => $currentDate->addMonths($frequency),
        };

        return $currentDate;
    }
}
