<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\PerantController;



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/parent/select-child', [PerantController::class, 'selectChildAndSendOtp'])->name('parent.selectChildAndSendOtp');

    Route::post('/child/verify-otp', [PerantController::class, 'verifyOtp'])->name('child.verifyOtp');
});
