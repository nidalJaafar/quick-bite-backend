<?php

namespace App\Http\Module\Limit\Policy;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LimitPolicy
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

}
