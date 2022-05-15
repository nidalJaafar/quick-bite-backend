<?php


use App\Http\Module\Currency\Controller\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CurrencyController::class)->group(function () {
        Route::post('/currencies', 'store');
        Route::put('/currencies/{currency}', 'update');
        Route::delete('/currencies/{currency}', 'destroy');
    });
});

Route::controller(CurrencyController::class)->group(function () {
    Route::get('/currencies', 'index');
    Route::get('/currencies/{currency}', 'show');
});
