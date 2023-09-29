<?php

declare(strict_types=1);

namespace App\Enums\Frequency;

enum FrequencyEnum : int
{
    /**
     * Check endpoint status in minutes
     *
     * @var int
     */
    case MINUTES = 1;

    /**
     * Check endpoint status in hours
     *
     * @var int
     */
    case HOURS = 2;

    /**
     * Check endpoint status in days
     *
     * @var int
     */
    case DAYS = 3;

    /**
     * Check endpoint status in weeks
     *
     * @var int
     */
    case WEEKS = 4;

    /**
     * Check endpoint status in months
     *
     * @var int
     */
    case MONTHS = 5;

    /**
     * @return array
     */
    public static function getAllFrequencies(): array
    {
        return [
            [
                'id'          => self::MINUTES->value,
                'description' => self::MINUTES->name
            ],
            [
                'id'          => self::HOURS->value,
                'description' => self::HOURS->name
            ],
            [
                'id'          => self::DAYS->value,
                'description' => self::DAYS->name
            ],
            [
                'id'          => self::WEEKS->value,
                'description' => self::WEEKS->name
            ],
            [
                'id'          => self::MONTHS->value,
                'description' => self::MONTHS->name
            ],
        ];
    }

    /**
     * @param int $value
     * @return FrequencyEnum
     */
    public static function getFrequency(int $value): FrequencyEnum
    {
        return match ($value) {
            self::MINUTES->value => self::MINUTES,
            self::HOURS->value   => self::HOURS,
            self::DAYS->value    => self::DAYS,
            self::WEEKS->value   => self::WEEKS,
            self::MONTHS->value  => self::MONTHS
        };
    }
}
