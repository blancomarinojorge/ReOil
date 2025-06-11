<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (
            $user->role === Role::Admin ||
            $user->role === Role::OfficeStaff
        ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        return true; // Any role can view as long as they're in the same company
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role === Role::Admin || $user->role === Role::OfficeStaff) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        if ($user->role !== Role::Admin && $user->role !== Role::OfficeStaff) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        if ($user->role !== Role::Admin && $user->role !== Role::OfficeStaff) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Client $model): bool
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
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Client $model): bool
    {
        if ($user->company_id !== $model->company_id) {
            return false;
        }

        if ($user->role !== Role::Admin) {
            return false;
        }

        return true;
    }
}

