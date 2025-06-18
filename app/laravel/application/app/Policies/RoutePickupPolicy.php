<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\Route;
use App\Models\RoutePickup;
use App\Models\User;

class RoutePickupPolicy
{
    protected function isPickupFromSameCompany(User $user, RoutePickup $routePickup): bool{
        return $routePickup->route->creator->company_id === $user->company_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RoutePickup $routePickup): bool
    {
        if (!$this->isPickupFromSameCompany($user, $routePickup)) {
            return false;
        }

        if ($user->role === Role::Driver && $routePickup->route->driver_id!==$user->id) {
            return false;
        }

        if ($user->role === Role::OfficeStaff && $routePickup->route->creator_id!==$user->id) {
            return false;
        }

        return true;
    }
}
