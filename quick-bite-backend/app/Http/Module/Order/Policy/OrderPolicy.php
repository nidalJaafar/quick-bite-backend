<?php

namespace App\Http\Module\Order\Policy;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
     * @param Order $order
     * @return bool
     */
    public function view(User $user, Order $order): bool
    {
        $order->load('user');
        return in_array($user->role, ['admin', 'super admin']) || $order->user->id == $user->id;
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
     * @param Order $order
     * @return bool
     */
    public function update(User $user, Order $order): bool
    {
        $order->load('user');
        return $order->user->id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function delete(User $user, Order $order): bool
    {
        $order->load('user');
        return $order->user->id == $user->id && $order->status == 'pending';
    }
}
