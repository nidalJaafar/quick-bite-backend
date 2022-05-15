<?php

use App\Http\Module\VisitFeedback\Controller\VisitFeedbackController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(VisitFeedbackController::class)->group(function () {
        Route::post('/visit_feedbacks', 'store');
        Route::put('/visit_feedbacks/{visitFeedback}', 'update');
        Route::delete('/visit_feedbacks/{visitFeedback}', 'destroy');
    });
});
Route::controller(VisitFeedbackController::class)->group(function () {
    Route::get('/visit_feedbacks', 'index');
    Route::get('/visit_feedbacks/{visitFeedback}', 'show');
});
