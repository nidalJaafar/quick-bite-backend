<?php

namespace App\Http\Module\Reservation\Policy;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
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
     * @param Reservation $reservation
     * @return bool
     */
    public function view(User $user, Reservation $reservation): bool
    {
        $reservation->load('user');
        return in_array($user->role, ['admin', 'super admin']) || $reservation->user->id == $user->id;
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
     * @param Reservation $reservation
     * @return bool
     */
    public function update(User $user, Reservation $reservation): bool
    {
        $reservation->load('user');
        return $reservation->user->id = $user->id && $reservation->status == 'pending';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        $reservation->load('user');
        return $reservation->user->id == $user->id && $reservation->status == 'pending';
    }
}
