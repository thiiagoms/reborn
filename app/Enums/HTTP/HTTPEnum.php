<?php

declare(strict_types=1);

namespace App\Enums\HTTP;

/**
 * Enum for all HTTP methods
 *
 * @package App\Enums\HTTP
 * @author  Thiago Silva <thiiagoms@proton.me>
 * @version 1.0
 */
enum HTTPEnum : int
{
    /**
     * HTTP GET method
     *
     * @var int
     */
    case GET = 1;

    /**
     * HTTP POST method
     *
     * @var int
     */
    case POST = 2;

    /**
     * HTTP PUT method
     *
     * @var int
     */
    case PUT = 3;

    /**
     * HTTP PATCH method
     *
     * @var int
     */
    case PATCH = 4;

    /**
     * HTTP DELETE method
     *
     * @var int
     */
    case DELETE = 5;

    /**
     * @return array
     */
    public static function getAllHTTPMethods(): array
    {
        return [
            [
                'id'          => self::GET->value,
                'description' => self::GET->name
            ],
            [
                'id'          => self::POST->value,
                'description' => self::POST->name
            ],
            [
                'id'          => self::PUT->value,
                'description' => self::PUT->name
            ],
            [
                'id'          => self::PATCH->value,
                'description' => self::PATCH->name
            ],
            [
                'id'          => self::DELETE->value,
                'description' => self::DELETE->name
            ]
        ];
    }

    /**
     * @param int $value
     * @return HTTPEnum
     */
    public static function getHTTPMethod(int $value): HTTPEnum
    {
        return match ($value) {
            self::GET->value    => self::GET,
            self::POST->value   => self::POST,
            self::PUT->value    => self::PUT,
            self::PATCH->value  => self::PATCH,
            self::DELETE->value => self::DELETE,
            default => throw new \InvalidArgumentException("Invalid HTTP method value: $value"),
        };
    }
}
