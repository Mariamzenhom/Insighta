<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\FacebookController;
use App\Http\Controllers\API\GoogleController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ResetPasswordOtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum', 'twofactor');

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

// ---------------------- Facebook usage tracking ----------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/facebook/usage/start', [FacebookController::class, 'startUsage']);
    Route::post('/facebook/usage/end', [FacebookController::class, 'endUsage']);
});

// ---------------------- Password reset with OTP ----------------------
Route::post('/password/reset/otp', [ResetPasswordOtpController::class, 'sendOtp']);
Route::post('/password/reset/verify', [ResetPasswordOtpController::class, 'verifyOtpAndReset']);

// ---------------------- Profile routes ----------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']);      // جلب البيانات
    Route::put('/profile', [ProfileController::class, 'update']);    // تعديل البيانات
    Route::delete('/profile', [ProfileController::class, 'destroy']); // حذف الحساب
});
Route::get('/profile/usage', [ProfileController::class, 'usage']); // جلب بيانات الاستخدام
Route::get('/profile/usage/facebook', [ProfileController::class, 'facebookUsage']); // جلب بيانات استخدام الفيسبوك
Route::get('/profile/usage/google', [ProfileController::class, 'googleUsage']); // جلب بيانات استخدام جوجل
Route::get('/profile/usage/other', [ProfileController::class, 'otherUsage']); // جلب بيانات استخدام التطبيقات الأخرى
Route::get('/profile/usage/other/{app}', [ProfileController::class, 'otherUsageByApp']); // جلب بيانات استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/start', [ProfileController::class, 'startOtherUsage']); // بدء استخدام تطبيق معين    
Route::get('/profile/usage/other/{app}/end', [ProfileController::class, 'endOtherUsage']); // إنهاء استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/delete', [ProfileController::class, 'deleteOtherUsage']); // حذف بيانات استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/delete/all', [ProfileController::class, 'deleteAllOtherUsage']); // حذف جميع بيانات استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/delete/all/confirm', [ProfileController::class, 'confirmDeleteAllOtherUsage']); // تأكيد حذف جميع بيانات استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/delete/confirm', [ProfileController::class, 'confirmDeleteOtherUsage']); // تأكيد حذف بيانات استخدام تطبيق معين
Route::get('/profile/usage/other/{app}/delete/confirm/all', [ProfileController::class, 'confirmDeleteAllOtherUsage']); // تأكيد حذف جميع بيانات استخدام تطبيق معين
