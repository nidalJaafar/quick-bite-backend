<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FaqPolicy
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
     * @param Faq $faq
     * @return bool
     */
    public function view(User $user, Faq $faq): bool
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
     * @param Faq $faq
     * @return bool
     */
    public function update(User $user, Faq $faq): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Faq $faq
     * @return bool
     */
    public function delete(User $user, Faq $faq): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Faq $faq
     * @return bool
     */
    public function restore(User $user, Faq $faq): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Faq $faq
     * @return bool
     */
    public function forceDelete(User $user, Faq $faq): bool
    {
        return in_array($user->role, ['admin', 'super admin']);
    }
}
