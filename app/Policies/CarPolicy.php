<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarPolicy
{



    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Car $car): bool
    {
        return $user->id === $car->owner->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Car $car): bool
    {

        return $user->id === $car->owner->id;
    }



    public function isOwner(User $user, Car $car)
    {

        return $user->id === $car->owner->id;
    }
}
