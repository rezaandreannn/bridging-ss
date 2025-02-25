<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berkas\Rekam_medis_by_mr\RekamMedisByMrController;

Route::prefix('rekam_medis')->name('rekam_medis.')->group(function () {
    // ------------------- Berkas By MR -------------------- //
    Route::get('riwayat/bymr/', [RekamMedisByMrController::class, 'index'])->name('bymr.index');
});