<?php

namespace App\Http\Module\Reservation\Service;

use App\Http\Module\Reservation\Mapper\ReservationMapper;
use App\Http\Module\Reservation\Request\ReservationRequest;
use App\Http\Module\Reservation\Resource\ReservationCollection;
use App\Http\Module\Reservation\Resource\ReservationResource;
use App\Models\Limit;
use App\Models\Reservation;
use Nette\ArgumentOutOfRangeException;
use Throwable;
use function auth;

class ReservationService
{
    private ReservationMapper $mapper;

    /**
     * @param ReservationMapper $mapper
     */
    public function __construct(ReservationMapper $mapper)
    {
        $this->mapper = $mapper;
    }


    public function getReservations(): ReservationCollection
    {
        $reservations = Reservation::with('user')->get();
        return new ReservationCollection($reservations);
    }

    /**
     * @throws Throwable
     */
    public function createRegistration(ReservationRequest $request)
    {
        $count = Reservation::where('status', 'pending')
            ->sum('number_of_people');
        $limit = Limit::all()->first()->limit;
        if ($count + $request->number_of_people > $limit)
            throw new ArgumentOutOfRangeException();
        $reservation = $this->mapper->reservationRequestToReservation($request);

        $reservation->saveOrFail();
    }

    public function getReservation(Reservation $reservation): ReservationResource
    {
        $reservation->load('user');
        return new ReservationResource($reservation);
    }

    /**
     * @throws Throwable
     */
    public function updateReservation(ReservationRequest $request, Reservation $reservation)
    {
        $reservation->updateOrFail($request->all());
    }

    /**
     * @throws Throwable
     */
    public function deleteReservation(Reservation $reservation)
    {
        $reservation->deleteOrFail();
    }
}
