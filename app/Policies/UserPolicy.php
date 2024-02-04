<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, User $model)
    {
        return $user->isSuperAdmin() || $user->id === $model->id || $model->isUser() && $user->isAdmin();
    }

    public function viewAny(User $user)
    {
        return $user->isSystemAdmin();
    }

    public function view(User $user)
    {
        return $user->isSystemAdmin();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }
}
