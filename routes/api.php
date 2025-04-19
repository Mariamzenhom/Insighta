<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\FacebookController;
use App\Http\Controllers\API\GoogleController;
use App\Http\Controllers\UsageController;
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

// ----------------------- Facebook routes ----------------------
Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// ---------------------- Auth routes ----------------------
Route::post('/auth/register', [RegisteredUserController::class, 'registerUser']);
Route::post('/auth/verify-account', [RegisteredUserController::class, 'verifyAccount']);
Route::post('/auth/login', [AuthenticatedSessionController::class, 'loginUser']);
Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/usage/start', [UsageController::class, 'startSession']);
    Route::post('/usage/end', [UsageController::class, 'endSession']);
    Route::get('/usage/report', [UsageController::class, 'getReport']);
    Route::post('/usage/check-threshold', [UsageController::class, 'checkThreshold']);
});


