<?php

use Illuminate\Support\Facades\Route;
use Modules\Therapist\Controllers\TherapistController;

Route::group(['middleware' => ['auth', 'verified'],'as'=>'therapist.'], function () {
    Route::get('/', [TherapistController::class, 'index'])->name('index');
    Route::get('/create', [TherapistController::class, 'create'])->name('create');
    Route::post('/', [TherapistController::class, 'store'])->name('store');
    Route::get('/{id}', [TherapistController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TherapistController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TherapistController::class, 'update'])->name('update');
    Route::delete('/{id}', [TherapistController::class, 'delete'])->name('delete');   ;
});
