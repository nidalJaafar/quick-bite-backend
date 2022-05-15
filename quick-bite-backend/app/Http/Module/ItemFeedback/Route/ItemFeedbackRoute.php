<?php

use App\Http\Module\ItemFeedback\Controller\ItemFeedbackController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ItemFeedbackController::class)->group(function () {
        Route::post('/item_feedbacks', 'store');
        Route::put('/item_feedbacks/{itemFeedback}', 'update');
        Route::delete('/item_feedbacks/{itemFeedback}', 'destroy');
    });
});

Route::controller(ItemFeedbackController::class)->group(function () {
    Route::get('/item_feedbacks', 'index');
    Route::get('/item_feedbacks/{itemFeedback}', 'show');
});
