<?php

namespace App\Http\Module\Reservation\Controller;

use App\Http\Controllers\Controller;
use App\Http\Module\Reservation\Request\ReservationRequest;
use App\Http\Module\Reservation\Service\ReservationService;
use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;
use function response;

class ReservationController extends Controller
{

    private ReservationService $service;

    /**
     * @param ReservationService $service
     */
    public function __construct(ReservationService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Reservation::class);
        return response()->json(['reservations' => $this->service->getReservations()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function store(ReservationRequest $request): JsonResponse
    {

        $this->authorize('create', Reservation::class);
        $this->service->createRegistration($request);
        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Reservation $reservation): JsonResponse
    {
        $this->authorize('view', $reservation);
        return response()->json(['reservation' => $this->service->getReservation($reservation)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationRequest $request
     * @param Reservation $reservation
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function update(ReservationRequest $request, Reservation $reservation): JsonResponse
    {
        $this->authorize('update', $reservation);
        $this->service->updateReservation($request, $reservation);
        return response()->json(status: 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        $this->authorize('delete', $reservation);
        $this->service->deleteReservation($reservation);
        return response()->json(status: 204);
    }
}
