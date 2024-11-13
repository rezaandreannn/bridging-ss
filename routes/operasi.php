<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ok\RuangOperasiController;
use App\Http\Controllers\OK\BookingOperasiController;
use App\Http\Controllers\OK\PenandaanOperasiController;

Route::prefix('operasi')->name('operasi.')->middleware('auth')->group(function () {

    // jadwal operasi
    Route::get('/jadwal-operasi', [PenandaanOperasiController::class, 'jadwal'])->name('jadwal.index');

    // Penandaan Lokasi Operasi
    Route::get('/penandaanOperasi', [PenandaanOperasiController::class, 'create'])->name('penandaan.create');
    // OK Ruangan
    Route::get('/ruangOperasi', [RuangOperasiController::class, 'index'])->name('ruang.index');
    Route::post('/ruangOperasi', [RuangOperasiController::class, 'store'])->name('ruang.store');
    Route::put('/ruangOperasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruang.update');
    Route::delete('/ruangOperasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruang.destroy');
});

// booking operasi
Route::get('/booking-operasi', [BookingOperasiController::class, 'index'])->name('operasi.booking.index');
Route::get('/create/booking-operasi', [BookingOperasiController::class, 'create'])->name('operasi.booking.create');
Route::post('/booking-operasi', [BookingOperasiController::class, 'store'])->name('operasi.booking.store');
