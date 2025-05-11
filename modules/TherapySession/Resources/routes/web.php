<?php

use Illuminate\Support\Facades\Route;
use Modules\TherapySession\Controllers\TherapySessionController;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [TherapySessionController::class, 'index'])->name('therapy.session.index');
    Route::post('/', [TherapySessionController::class, 'store'])->name('therapy.session.store');
    Route::get('/create', [TherapySessionController::class, 'create'])->name('therapy.session.create');
});
