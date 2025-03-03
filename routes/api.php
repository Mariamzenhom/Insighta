<?php

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\API\GoogleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google-callback', [GoogleController::class, 'handleGoogleCallback']);

