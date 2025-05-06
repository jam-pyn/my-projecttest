<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Roles;

class RolesPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkRole('SADM');
    }

    public function view(User $user, Roles $role): bool
    {
        return $user->checkRole('SADM');
    }

    public function create(User $user): bool
    {
        return $user->checkRole('SADM');
    }

    public function update(User $user, Roles $role): bool
    {
        return $user->checkRole('SADM');
    }

    public function delete(User $user, Roles $role): bool
    {
        return $user->checkRole('SADM');
    }
}
