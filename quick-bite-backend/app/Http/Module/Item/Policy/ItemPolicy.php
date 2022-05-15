<?php

namespace App\Http\Module\Item\Policy;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

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
     * @param Item $item
     * @return bool
     */
    public function update(User $user, Item $item): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Item $item
     * @return bool
     */
    public function delete(User $user, Item $item): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

}
