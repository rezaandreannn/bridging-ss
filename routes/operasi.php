<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ok\RuangOperasiController;
use App\Http\Controllers\OK\BookingOperasiController;
use App\Http\Controllers\OK\JadwalOperasiController;
use App\Http\Controllers\OK\PenandaanOperasiController;
use App\Http\Controllers\OK\TtdTandaOperasiController;


Route::prefix('operasi')->name('operasi.')->middleware('auth')->group(function () {
    // jadwal operasi
    Route::get('jadwal-operasi', JadwalOperasiController::class)->name('jadwal.index');

    // Route::get('/jadwal-operasi', [PenandaanOperasiController::class, 'jadwal'])->name('jadwal.index');

    // Penandaan Lokasi Operasi
    Route::get('penandaan-operasi', [PenandaanOperasiController::class, 'index'])->name('penandaan.index');
    Route::get('/penandaan-operasi/{noReg}', [PenandaanOperasiController::class, 'create'])->name('penandaan.create');
    Route::post('penandaan-operasi', [PenandaanOperasiController::class, 'store'])->name('penandaan.store');
    Route::get('/penandaan-operasi/{id}/edit', [PenandaanOperasiController::class, 'edit'])->name('penandaan.edit');


    // OK Ruangan
    Route::get('/ruang-operasi', [RuangOperasiController::class, 'index'])->name('ruang.index');
    Route::post('/ruang-operasi', [RuangOperasiController::class, 'store'])->name('ruang.store');
    Route::put('/ruang-operasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruang.update');
    Route::delete('/ruang-operasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruang.destroy');
});

// booking operasi
Route::get('/booking-operasi', [BookingOperasiController::class, 'index'])->name('operasi.booking.index');
Route::get('/create/booking-operasi', [BookingOperasiController::class, 'create'])->name('operasi.booking.create');
Route::get('booking-operasi/{id}/edit', [BookingOperasiController::class, 'edit'])->name('operasi.booking.edit');
Route::post('/booking-operasi', [BookingOperasiController::class, 'store'])->name('operasi.booking.store');
Route::put('/booking-operasi/{id}', [BookingOperasiController::class, 'update'])->name('operasi.booking.update');

Route::delete('/booking-operasi/delete/{id}', [BookingOperasiController::class, 'destroy'])->name('operasi.booking.destroy');

Route::prefix('ttd-ok')->name('ttd-ok.')->middleware('auth')->group(function () {

    Route::get('tanda-operasi', [TtdTandaOperasiController::class, 'index'])->name('penandaan.index');
    Route::get('create/tanda-operasi', [TtdTandaOperasiController::class, 'create'])->name('penandaan.create');
});

Route::put('/booking-operasi/tanggal/{id}', [BookingOperasiController::class, 'updateTanggal'])->name('operasi.tanggal.update');
Route::put('/booking-operasi/ruangan/{id}', [BookingOperasiController::class, 'updateRuangan'])->name('operasi.ruangan.update');
Route::delete('/booking-operasi/delete/{id}', [BookingOperasiController::class, 'destroy'])->name('operasi.booking.destroy');
