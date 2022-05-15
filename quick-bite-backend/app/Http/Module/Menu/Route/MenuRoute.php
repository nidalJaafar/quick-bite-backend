<?php

use App\Http\Module\Menu\Controller\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(MenuController::class)->group(function () {
        Route::post('/menus', 'store');
        Route::put('/menus/{menu}', 'update');
        Route::delete('/menus/{menu}', 'destroy');
    });
});

Route::controller(MenuController::class)->group(function () {
    Route::get('/menus', 'index');
    Route::get('/menus/{menu}', 'show');
});
