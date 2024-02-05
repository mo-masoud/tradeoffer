<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;

class BranchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('branches.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Branch $branch): bool
    {
        return $user->can('branches.create')
            || ($user->can('branches.view') && $user->id === $branch->store->user_id)
            || ($user->can('branches.view') && $user->id === $branch->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('branches.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Branch $branch): bool
    {
        return $user->can('branches.create')
            || ($user->can('branches.view') && $user->id === $branch->store->user_id)
            || ($user->can('branches.view') && $user->id === $branch->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return $user->can('branches.create');
    }
}
