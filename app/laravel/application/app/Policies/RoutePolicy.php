<?php

namespace App\Policies;

use App\Enums\Auth\Role;
use App\Models\Route;
use App\Models\User;

class RoutePolicy
{
    protected function isSameCompany(User $user, Route $route){
        return $route->creator->company_id === $user->company_id;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, Role::cases());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Route $route): bool
    {
        if (!$this->isSameCompany($user, $route)) return false;

        if ($user->role === Role::Driver && $route->driver_id !== $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === Role::Admin || $user->role === Role::OfficeStaff;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Route $route): bool
    {
        if (!$this->isSameCompany($user, $route)) return false;

        if ($user->role === Role::Driver) {
            return false;
        }

        if ($user->role === Role::OfficeStaff && $route->creator_id !== $user->id) {
            return false;
        }

        return true;
    }

    public function updateState(User $user, Route $route): bool{
        if (!$this->isSameCompany($user, $route)) return false;

        if($user->role === Role::Driver && $route->driver_id !== $user->id){
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Route $route): bool
    {
        if (!$this->isSameCompany($user, $route)) return false;

        if ($user->role === Role::Driver) {
            return false;
        }

        if ($user->role === Role::OfficeStaff && $route->creator_id !== $user->id) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Route $route): bool
    {
        if (!$this->isSameCompany($user, $route)) return false;

        return $user->role === Role::Admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Route $route): bool
    {
        if (!$this->isSameCompany($user, $route)) return false;

        return $user->role === Role::Admin;
    }
}
