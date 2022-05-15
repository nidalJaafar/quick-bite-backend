<?php

use App\Http\Module\Limit\Controller\LimitController;
use Illuminate\Support\Facades\Route;

Route::post('/limits', [LimitController::class, 'store'])
    ->middleware('auth:sanctum');
Route::get('/limits', [LimitController::class, 'index']);
