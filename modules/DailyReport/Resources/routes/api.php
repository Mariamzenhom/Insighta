<?php

use Illuminate\Support\Facades\Route;
use Modules\DailyReport\Controllers\DailyReportController;

    Route::post('/', [DailyReportController::class, 'store']);
