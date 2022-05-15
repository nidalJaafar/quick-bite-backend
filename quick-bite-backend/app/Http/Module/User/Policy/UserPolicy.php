<?php

namespace App\Http\Module\User\Policy;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return in_array($user->role, ['admin', 'super admin']) || $user->id == $model->id;
    }

    public function createAdmin(User $user): bool
    {
        return $user->role == 'super admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return in_array($user->role, ['admin', 'super admin']) || $user->id == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return (in_array($user->role, ['admin', 'super admin']) || $user->id == $model->id) && $model->role != 'super admin';
    }
}
