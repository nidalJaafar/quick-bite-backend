<?php

namespace App\Policies;

use App\Models\ItemFeedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemFeedbackPolicy
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
     * @param ItemFeedback $itemFeedback
     * @return bool
     */
    public function view(User $user, ItemFeedback $itemFeedback): bool
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
        return $user->role == 'client';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ItemFeedback $itemFeedback
     * @return bool
     */
    public function update(User $user, ItemFeedback $itemFeedback): bool
    {
        $user->load('itemFeedbacks');
        return in_array($itemFeedback->id, array_map(fn($i) => $i['id'], $user->itemFeedbacks->toArray()));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ItemFeedback $itemFeedback
     * @return bool
     */
    public function delete(User $user, ItemFeedback $itemFeedback): bool
    {
        $user->load('itemFeedbacks');
        return in_array($itemFeedback->id, array_map(fn($i) => $i['id'], $user->itemFeedbacks->toArray()));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ItemFeedback $itemFeedback
     * @return bool
     */
    public function restore(User $user, ItemFeedback $itemFeedback): bool
    {
        $user->load('itemFeedbacks');
        return in_array($itemFeedback->id, array_map(fn($i) => $i['id'], $user->itemFeedbacks->toArray()));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param ItemFeedback $itemFeedback
     * @return bool
     */
    public function forceDelete(User $user, ItemFeedback $itemFeedback): bool
    {
        $user->load('itemFeedbacks');
        return in_array($itemFeedback->id, array_map(fn($i) => $i['id'], $user->itemFeedbacks->toArray()));
    }
}
