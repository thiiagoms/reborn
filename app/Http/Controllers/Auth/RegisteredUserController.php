<?php

namespace App\Http\Controllers\Auth;

use App\DTO\User\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Providers\RouteServiceProvider;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        UserService::store(
            new UserDTO(...$request->except(['_token', 'password_confirmation']))
        );

        return redirect(RouteServiceProvider::HOME);
    }
}
