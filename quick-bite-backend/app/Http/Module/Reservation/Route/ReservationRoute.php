<?php

use App\Http\Module\Reservation\Controller\ReservationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources(['reservations' => ReservationController::class]);
});
