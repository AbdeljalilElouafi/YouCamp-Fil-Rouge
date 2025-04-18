<?php

namespace App\Policies;

use App\Models\Auberge;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AubergePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Auberge $auberge)
    {
        return $user->id === $auberge->manager_id;
    }

    public function delete(User $user, Auberge $auberge)
    {
        return $user->id === $auberge->manager_id;
    }
}