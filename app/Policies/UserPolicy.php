<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view another user's details.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess(['view-user']);
    }

    /**
     * Determine whether the user can create a new user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['create-user']);
    }

    /**
     * Determine whether the user can update another user's details.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess(['update-user']);
    }

    /**
     * Determine whether the user can delete another user's details.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess(['delete-user']);
    }

    /**
     * Determine whether the user can change another user's role.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function promote(User $user)
    {
        return $user->hasAccess(['promote-user']);
    }

    /**
     * Determine whether the user can deactivate another user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->hasAccess(['deactivate-user']);
    }
}
