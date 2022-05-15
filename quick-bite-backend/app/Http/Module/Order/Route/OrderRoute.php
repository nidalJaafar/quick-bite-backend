<?php

use App\Http\Module\Order\Controller\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources(['orders' => OrderController::class]);
});
