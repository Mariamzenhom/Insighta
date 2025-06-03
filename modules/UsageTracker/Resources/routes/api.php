<?php

use Illuminate\Support\Facades\Route;
use Modules\UsageTracker\Controllers\Api\UsageController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/track-usage', [UsageController::class, 'track']);
    Route::get('/usage-chart', [UsageController::class, 'usageChart']);
});
