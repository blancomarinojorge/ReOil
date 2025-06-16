<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\Route;
use App\Models\RoutePickup;
use App\Models\User;

class RoutePickupPolicy
{
    protected function isRouteFromSameCompany(User $user, Route $route): bool{
        return $route->creator->company_id === $user->company_id;
    }

    protected function isPickupFromSameCompany(User $user, RoutePickup $routePickup): bool{
        return $routePickup->route->creator->company_id === $user->company_id;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Route $route): bool
    {
        if (!$this->isRouteFromSameCompany($user, $route)) {
            return false;
        }

        if ($user->role === Role::Driver && $route->driver_id!==$user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RoutePickup $routePickup): bool
    {
        if (!$this->isPickupFromSameCompany($user, $routePickup)) {
            return false;
        }

        if ($user->role === Role::Driver && $routePickup->route->driver_id!==$user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Route $route): bool
    {
        if ($user->role === Role::Driver){
            return false;
        }

        if (!$this->isRouteFromSameCompany($user, $route)) {
            return false;
        }

        if ($user->role === Role::OfficeStaff && $route->creator_id!==$user->id) {
            return false;
        }

        return true;
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

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoutePickup $routePickup): bool
    {
        if ($user->role === Role::Driver){
            return false;
        }

        if (!$this->isPickupFromSameCompany($user, $routePickup)) {
            return false;
        }

        if ($user->role === Role::OfficeStaff && $routePickup->route->creator_id!==$user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoutePickup $routePickup): bool
    {
        if ($user->role !== Role::Admin){
            return false;
        }

        if (!$this->isPickupFromSameCompany($user, $routePickup)) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoutePickup $routePickup): bool
    {
        if ($user->role !== Role::Admin){
            return false;
        }

        if (!$this->isPickupFromSameCompany($user, $routePickup)) {
            return false;
        }

        return true;
    }
}
