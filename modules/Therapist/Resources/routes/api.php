<?php

use Illuminate\Support\Facades\Route;
use Modules\Therapist\Controllers\TherapistController;

Route::group(['middleware' => ['auth:sanctum'],'as'=>'therapist.'], function () {
    Route::get('/', [TherapistController::class, 'index'])->name('index');
    Route::post('/', [TherapistController::class, 'store'])->name('store');
    Route::get('/{id}', [TherapistController::class, 'show'])->name('show');
    Route::post('/{id}', [TherapistController::class, 'update'])->name('update');
    Route::delete('/{id}', [TherapistController::class, 'delete'])->name('delete');   ;
});
