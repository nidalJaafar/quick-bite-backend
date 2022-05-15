<?php

use App\Http\Module\Image\Controller\ImageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ImageController::class)->group(function () {
        Route::post('/images', 'store');
        Route::delete('/images/{image}', 'destroy');
    });
});
Route::controller(ImageController::class)->group(function () {
    Route::get('/images', 'index');
    Route::get('/images/{image}', 'show');
});
