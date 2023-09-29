<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;

abstract class Service
{
    /**
     * Model
     *
     * @var mixed
     */
    protected $model;

    /**
     * @param string $field
     * @return string
     */
    protected static function removeTags(string $field): string
    {
        return trim(strip_tags($field));
    }

    /**
     * @return string
     */
    protected static function getUserAuthId(): string
    {
        return Auth::user()->id;
    }
}
