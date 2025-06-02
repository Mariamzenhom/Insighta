<?php

use Illuminate\Support\Facades\Route;
use Modules\DailyReport\Controllers\DailyReportController;

    Route::post('/', [DailyReportController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/', [DailyReportController::class, 'index'])->name('daily_reports.index');
});
