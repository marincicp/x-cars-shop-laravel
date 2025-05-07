<?php

namespace App\Policies;

use App\Models\CarComment;
use App\Models\User;

class CarCommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, CarComment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}
