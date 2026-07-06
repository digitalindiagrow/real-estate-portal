<?php

namespace App\Policies;

use App\Models\Reel;
use App\Models\User;

class ReelPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function delete(User $user, Reel $reel): bool
    {
        return $user->isAdmin() || $user->id === $reel->user_id;
    }
}
