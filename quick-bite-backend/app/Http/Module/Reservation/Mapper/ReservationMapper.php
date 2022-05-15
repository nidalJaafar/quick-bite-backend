<?php

namespace App\Http\Module\Reservation\Mapper;

use App\Http\Module\Reservation\Request\ReservationRequest;
use App\Models\Reservation;

class ReservationMapper
{
    public function reservationRequestToReservation(ReservationRequest $request): Reservation
    {
        $reservation = new Reservation($request->all());
        $reservation->user_id = auth()->user()->id;
        $reservation->status = 'pending';
        return $reservation;
    }
}
