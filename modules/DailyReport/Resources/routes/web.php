<?php

use Illuminate\Support\Facades\Route;
use Modules\DailyReport\Controllers\DailyReportController;

    Route::get('/', [DailyReportController::class, 'index'])->name('daily_reports.index');
