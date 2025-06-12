<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ResetPasswordOtpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\API\FacebookController;
use App\Http\Controllers\API\GoogleController;
use App\Http\Controllers\AIRecommendationController;

// ------------------ Public Auth Routes ------------------
Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'registerUser']);
    Route::post('/login', [AuthenticatedSessionController::class, 'loginUser']);

    // Social login
    Route::get('/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::get('/facebook', [FacebookController::class, 'redirectToFacebook']);
    Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

    // Password Reset with OTP
    Route::post('/password/reset/otp', [ResetPasswordOtpController::class, 'sendOtp']);
    Route::post('/password/reset/verify', [ResetPasswordOtpController::class, 'verifyOtp']);
    Route::post('/password/reset/confirm', [ResetPasswordOtpController::class, 'resetPassword']);
});

// ------------------ Protected Routes (auth:sanctum) ------------------
Route::middleware('auth:sanctum')->group(function () {

    // MFA check on user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('twofactor');

    // Auth logout
    Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Profile management
    // Profile management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit']);       // Get profile
        Route::put('/', [ProfileController::class, 'updateName']);     // Update profile
        Route::delete('/', [ProfileController::class, 'destroy']); // Delete profile
        Route::post('/avatar', [ProfileController::class, 'updateAvatar']); // ✅ New
    });

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
});

// ------------------ AI Recommendations ------------------
Route::prefix('ai')->group(function () {
    Route::post('/recommend/emotions', [AIRecommendationController::class, 'getEmotionRecommendations']);
    Route::post('/recommend/content', [AIRecommendationController::class, 'getContentRecommendations']);
    Route::get('/emotions', [AIRecommendationController::class, 'getAvailableEmotions']);
});
