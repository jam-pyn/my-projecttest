<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view($roles_code, User $user)
    {
        return $user->role->roles_code === "SADM";
        // return $user->role->roles_code === "MOD";
        // return $user->role->roles_code === $roles_code;
    }

    // ...
}
