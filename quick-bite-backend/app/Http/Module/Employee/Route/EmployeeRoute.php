<?php

use App\Http\Module\Employee\Controller\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('/employees', 'store');
        Route::put('/employees/{employee}', 'update');
        Route::delete('/employees/{employee}', 'destroy');
    });
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index');
    Route::get('/employees/{employee}', 'show');
    Route::get('/employees/images/{employee}', 'showImage');
});
