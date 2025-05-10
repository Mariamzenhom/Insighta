<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\UserController;



Route::middleware(['auth'])->group(function () {
    Route::get('/parent/select-child', [UserController::class, 'showSelectChildPage'])->name('parent.selectChildPage');
    Route::post('/parent/select-child', [UserController::class, 'selectChildAndSendOtp'])->name('parent.selectChildAndSendOtp');

    Route::get('/child/verify-otp', [UserController::class, 'showVerifyOtpPage'])->name('child.verifyOtpPage');
    Route::post('/child/verify-otp', [UserController::class, 'verifyOtp'])->name('child.verifyOtp');
});
