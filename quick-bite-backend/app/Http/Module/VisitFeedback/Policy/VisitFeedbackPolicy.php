<?php

namespace App\Http\Module\VisitFeedback\Policy;

use App\Models\User;
use App\Models\VisitFeedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitFeedbackPolicy
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
        return $user->role == 'client';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param VisitFeedback $visitFeedback
     * @return bool
     */
    public function update(User $user, VisitFeedback $visitFeedback): bool
    {
        return $user->visitFeedback->id == $visitFeedback->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param VisitFeedback $visitFeedback
     * @return bool
     */
    public function delete(User $user, VisitFeedback $visitFeedback): bool
    {
        return $user->visitFeedback->id == $visitFeedback->id;
    }

}
