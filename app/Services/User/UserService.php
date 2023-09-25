<?php

namespace App\Services\User;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Services\Service;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Hash
};

final class UserService extends Service
{
    protected $model = User::class;

    /**
     * @param string $password
     * @return string
     */
    private static function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    /**
     * @param UserDTO $userDTO
     * @return void
     */
    public static function store(UserDTO $userDTO): void
    {
        $userDTO->password = self::hashPassword($userDTO->password);

        DB::transaction(function () use ($userDTO) {

            $user = User::create((array) $userDTO);

            if ($user instanceof User) {
                event(new Registered($user));

                Auth::login($user);
            }
        });
    }
}
