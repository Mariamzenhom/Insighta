<?php

use App\Http\Controllers\API\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\API\GoogleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google',  'redirectToGoogle');
    Route::get('/auth/google/callback',  'handleGoogleCallback');
});

Route::post('/auth/register', [UserController::class,'createUser']);
Route::post('/auth/login', [UserController::class,'loginUser']);

