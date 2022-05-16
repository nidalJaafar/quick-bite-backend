<?php

use App\Http\Module\User\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources(['users' => UserController::class]);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/admins', [UserController::class, 'indexAdmins']);
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/signup', 'signup');
});
