<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function view(User $user, Menu $menu): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function update(User $user, Menu $menu): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function delete(User $user, Menu $menu): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function restore(User $user, Menu $menu): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Menu $menu
     * @return bool
     */
    public function forceDelete(User $user, Menu $menu): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }
}
