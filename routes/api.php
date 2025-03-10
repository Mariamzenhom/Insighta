<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\API\GoogleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum','twofactor');


// ----------------------- Google routes ----------------------
Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});

// ---------------------- Auth routes ----------------------
Route::post('/auth/register', [RegisteredUserController::class, 'registerUser']);
Route::post('/auth/login', [AuthenticatedSessionController::class, 'loginUser']);
Route::post('/verify-otp', [VerifyEmailController::class, 'verifyOtp']);
Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum');



