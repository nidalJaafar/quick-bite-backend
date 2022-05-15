<?php

namespace App\Http\Module\Image\Policy;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
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
     * @param Image $image
     * @return bool
     */
    public function update(User $user, Image $image): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Image $image
     * @return bool
     */
    public function delete(User $user, Image $image): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

}
