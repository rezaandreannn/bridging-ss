<?php

use App\Http\Controllers\Vclaim\Monitoring\KlaimController;
use App\Http\Controllers\Vclaim\Monitoring\KunjunganController;
use App\Http\Controllers\Vclaim\TestController;
use Illuminate\Support\Facades\Route;

Route::get('diag/', [TestController::class, 'getDiagnosa']);

// Route Prefix
Route::prefix('vclaim')->group(function () {
    // Monitoring
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('kunjungan', [KunjunganController::class, 'index'])->name('kunjungan');
        Route::get('klaim', [KlaimController::class, 'index'])->name('klaim');
    });
});
