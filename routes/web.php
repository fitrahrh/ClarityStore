<?php

use App\Http\Controllers\TopUpController;

Route::get('/topup', [TopUpController::class, 'showForm']);
Route::post('/topup', [TopUpController::class, 'processTopUp'])->name('topup.process');
Route::get('/topup/status', [TopUpController::class, 'status'])->name('topup.status');

