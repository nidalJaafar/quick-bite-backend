<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemFeedbackController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitFeedbackController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::controller(CurrencyController::class)->group(function () {
        Route::post('/currencies', 'store');
        Route::put('/currencies/{currency}', 'update');
        Route::delete('/currencies/{currency}', 'destroy');
    });
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('/employees', 'store');
        Route::put('/employees/{employee}', 'update');
        Route::delete('/employees/{employee}', 'destroy');
    });
    Route::controller(FaqController::class)->group(function () {
        Route::post('/faqs', 'store');
        Route::put('/faqs/{faq}', 'update');
        Route::delete('/faqs/{faq}', 'destroy');
    });
    Route::controller(ItemController::class)->group(function () {
        Route::post('/items', 'store');
        Route::put('/items/{item}', 'update');
        Route::delete('/items/{item}', 'destroy');
    });
    Route::controller(ImageController::class)->group(function () {
        Route::post('/images', 'store');
        Route::delete('/images/{image}', 'destroy');
    });
    Route::apiResources([
        'users' => UserController::class,
        'orders' => OrderController::class,
    ]);
});

Route::controller(CurrencyController::class)->group(function () {
    Route::get('/currencies', 'index');
    Route::get('/currencies/{currency}', 'show');
});
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index');
    Route::get('/employees/{employee}', 'show');
    Route::get('/employees/images/{employee}', 'showImage');
});
Route::controller(FaqController::class)->group(function () {
    Route::get('/faqs', 'index');
    Route::get('/faqs/{faq}', 'show');
});
Route::controller(ItemController::class)->group(function () {
    Route::get('/items', 'index');
    Route::get('/items/{item}', 'show');
});
Route::controller(MenuController::class)->group(function () {
    Route::get('/menus', 'index');
    Route::get('/menus/{menu}', 'show');
});
Route::controller(VisitFeedbackController::class)->group(function () {
    Route::get('/visit_feedbacks', 'index');
    Route::get('/visit_feedbacks/{visitFeedback}', 'show');
});
Route::controller(ItemFeedbackController::class)->group(function () {
    Route::get('/item_feedbacks', 'index');
    Route::get('/item_feedbacks/{itemFeedback}', 'show');
});
Route::controller(ImageController::class)->group(function () {
    Route::get('/images', 'index');
    Route::get('/images/{image}', 'show');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/signup', 'signup');
});
