<?php

namespace App\Services;

use App\Exceptions\HttpErrorResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService
{
    /**
     * AuthService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(private UserRepository $userRepository)
    {
        //
    }

    /**
     * Register user.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    /**
     * Login user.
     *
     * @param $data
     * @return Authenticatable
     * @throws HttpErrorResponse
     */
    public function loginUser($data): Authenticatable
    {
        $user = $this->userRepository->getUserByEmail($data['email']);
        if (!$user || !auth()->attempt($data)) {
            throw new HttpErrorResponse('authentication error', [
                'login' => [__('auth.failed')],
            ]);
        }

        return auth()->user();
    }

    /**
     * Logout user.
     *
     * @return void
     */
    public function logoutUser(): void
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
