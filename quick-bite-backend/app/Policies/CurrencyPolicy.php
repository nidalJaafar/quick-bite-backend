<?php

namespace App\Policies;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
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
     * @param Currency $currency
     * @return bool
     */
    public function view(User $user, Currency $currency): bool
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
     * @param Currency $currency
     * @return bool
     */
    public function update(User $user, Currency $currency): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Currency $currency
     * @return bool
     */
    public function delete(User $user, Currency $currency): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Currency $currency
     * @return bool
     */
    public function restore(User $user, Currency $currency): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Currency $currency
     * @return bool
     */
    public function forceDelete(User $user, Currency $currency): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }
}
