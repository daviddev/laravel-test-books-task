<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Get user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::firstWhere('email', $email);
    }


    /**
     * Create new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return User::create($data);
    }

    /**
     * Book checkout.
     *
     * @param array $data
     * @return void
     */
    public function checkoutBook(array $data): void
    {
        $user = User::find($data['user_id']);
        $user->books()->attach([
            $data['book_id'] => ['checkout_date' => now()]
        ]);
    }
}
