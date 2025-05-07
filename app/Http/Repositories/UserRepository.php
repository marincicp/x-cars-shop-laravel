<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Update the current user data
     *
     * @return bool
     */
    public function updateCurrentUser(User $user, array $data)
    {
        return $user->update($data);
    }
}
