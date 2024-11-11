<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ok\RuangOperasiController;
use App\Http\Controllers\OK\BookingOperasiController;
use App\Http\Controllers\OK\PenandaanOperasiController;

Route::prefix('operasi')->name('operasi.')->group(function () {
    // booking operasi
    Route::get('/booking-operasi', [BookingOperasiController::class, 'index'])->name('booking.index');

    // jadwal operasi
    Route::get('/jadwal-operasi', [PenandaanOperasiController::class, 'jadwal'])->name('jadwal.index');

    // Penandaan Lokasi Operasi
    Route::get('/penandaanOperasi', [PenandaanOperasiController::class, 'index'])->name('pendandaanOperasi.index');
    // OK Ruangan
    Route::get('/ruangOperasi', [RuangOperasiController::class, 'index'])->name('ruang.index');
    Route::post('/ruangOperasi', [RuangOperasiController::class, 'store'])->name('ruang.store');
    Route::put('/ruangOperasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruang.update');
    Route::delete('/ruangOperasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruang.destroy');
});
