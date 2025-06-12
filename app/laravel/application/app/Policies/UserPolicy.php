<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view the list of users.
     *
     * @param  User  $user  The authenticated user.
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::Admin || $user->role === Role::OfficeStaff;
    }

    /**
     * Determine whether the user can view the given user.
     *
     * @param  User  $user   The authenticated user.
     * @param  User  $model  The user being viewed.
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        //The drivers CAN SEE their own profiles
        if ($user->role === Role::Driver && $user->id !== $model->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create new users.
     *
     * @param  User  $user  The authenticated user.
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role === Role::Admin;
    }

    /**
     * Determine whether the user can update the given user.
     *
     * @param  User  $user   The authenticated user.
     * @param  User  $model  The user being updated.
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        if ($user->role !== Role::Admin) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the given user.
     *
     * @param  User  $user   The authenticated user.
     * @param  User  $model  The user being deleted.
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        if ($user->role !== Role::Admin) {
            return false;
        }

        if ($user->id === $model->id){
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the given soft-deleted user.
     *
     * @param  User  $user   The authenticated user.
     * @param  User  $model  The user being restored.
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        return $user->role === Role::Admin;
    }

    /**
     * Determine whether the user can permanently delete the given soft-deleted user.
     *
     * @param  User  $user   The authenticated user.
     * @param  User  $model  The user being permanently deleted.
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        // Admins cannot force delete themselves either (optional)
        if ($user->id === $model->id) {
            return false;
        }

        return $user->role === Role::Admin;
    }
}
