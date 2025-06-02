<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\UserController;



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/parent/select-child', [UserController::class, 'selectChildAndSendOtp'])->name('parent.selectChildAndSendOtp');

    Route::post('/child/verify-otp', [UserController::class, 'verifyOtp'])->name('child.verifyOtp');
});
