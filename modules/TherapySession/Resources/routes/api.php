<?php

use Illuminate\Support\Facades\Route;
use Modules\TherapySession\Controllers\TherapySessionController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', [TherapySessionController::class, 'index'])->name('therapy.session.index');
    Route::post('/', [TherapySessionController::class, 'store'])->name('therapy.session.store');
    Route::get('/{id}', [TherapySessionController::class, 'show'])->name('therapy.session.show');
    Route::put('/{id}', [TherapySessionController::class, 'update'])->name('therapy.session.update');
    Route::delete('/{id}', [TherapySessionController::class, 'destroy'])->name('therapy.session.destroy');
});
