<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemFeedbackController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitFeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'users' => UserController::class,
    'currencies' => CurrencyController::class,
    'images' => ImageController::class,
    'items' => ItemController::class,
    'item_feedbacks' => ItemFeedbackController::class,
    'menus' => MenuController::class,
    'orders' => OrderController::class,
    'visit_feedbacks' => VisitFeedbackController::class
]);
