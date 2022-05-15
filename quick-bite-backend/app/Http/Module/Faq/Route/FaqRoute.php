<?php

use App\Http\Module\Faq\Controller\FaqController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(FaqController::class)->group(function () {
        Route::post('/faqs', 'store');
        Route::put('/faqs/{faq}', 'update');
        Route::delete('/faqs/{faq}', 'destroy');
    });
});

Route::controller(FaqController::class)->group(function () {
    Route::get('/faqs', 'index');
    Route::get('/faqs/{faq}', 'show');
});
