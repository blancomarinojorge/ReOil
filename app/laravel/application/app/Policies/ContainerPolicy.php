<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\Container;
use App\Models\User;

class ContainerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::Admin || $user->role === Role::OfficeStaff || $user->role === Role::Driver;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Container $container): bool
    {
        if ($container->client->company_id !== $user->company_id) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Container $container): bool
    {
        if ($container->client->company_id !== $user->company_id) {
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
    public function delete(User $user, Container $container): bool
    {
        if ($container->client->company_id !== $user->company_id) {
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
    public function restore(User $user, Container $container): bool
    {
        if ($container->client->company_id !== $user->company_id) {
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
    public function forceDelete(User $user, Container $container): bool
    {
        if ($container->client->company_id !== $user->company_id) {
            return false;
        }
        if ($user->role !== Role::Admin) {
            return false;
        }

        return true;
    }
}
