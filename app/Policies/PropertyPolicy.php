<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Property $property): bool
    {
        return $user->isAdmin() || $user->id === $property->user_id;
    }

    public function delete(User $user, Property $property): bool
    {
        return $user->isAdmin() || $user->id === $property->user_id;
    }
}
