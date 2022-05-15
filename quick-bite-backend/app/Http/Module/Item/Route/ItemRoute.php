<?php

use App\Http\Module\Item\Controller\ItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ItemController::class)->group(function () {
        Route::post('/items', 'store');
        Route::put('/items/{item}', 'update');
        Route::delete('/items/{item}', 'destroy');
    });
});

Route::controller(ItemController::class)->group(function () {
    Route::get('/items', 'index');
    Route::get('/items/{item}', 'show');
});
