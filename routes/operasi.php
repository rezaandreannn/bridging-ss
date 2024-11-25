<?php

use App\Http\Controllers\Ok\AssesmenPraBedahController;
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
    Route::put('/penandaan-operasi/{id}/update', [PenandaanOperasiController::class, 'update'])->name('penandaan.update');
    Route::delete('/penandaan-operasi/delete/{id}', [PenandaanOperasiController::class, 'destroy'])->name('penandaan.destroy');
    Route::get('/penandaan-operasi/cetak/{kode_register}', [PenandaanOperasiController::class, 'cetak'])->name('penandaan.cetak');


    // OK Ruangan
    Route::get('/ruang-operasi', [RuangOperasiController::class, 'index'])->name('ruang.index');
    Route::post('/ruang-operasi', [RuangOperasiController::class, 'store'])->name('ruang.store');
    Route::put('/ruang-operasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruang.update');
    Route::delete('/ruang-operasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruang.destroy');

    // Asesmen Pra Bedah
    Route::get('/assesmen-prabedah', [AssesmenPraBedahController::class, 'index'])->name('assesmen-prabedah.index');
    Route::get('/assesmen-prabedah/create', [AssesmenPraBedahController::class, 'create'])->name('assesmen-prabedah.create');
    Route::post('/assesmen-prabedah', [AssesmenPraBedahController::class, 'store'])->name('assesmen-prabedah.store');
    Route::put('/assesmen-prabedah/update/{id}', [AssesmenPraBedahController::class, 'update'])->name('assesmen-prabedah.update');
    Route::delete('/assesmen-prabedah/delete/{id}', [AssesmenPraBedahController::class, 'destroy'])->name('assesmen-prabedah.destroy');
});

// booking operasi
Route::get('/booking-operasi', [BookingOperasiController::class, 'index'])->name('operasi.booking.index');
Route::get('/booking-operasi/create', [BookingOperasiController::class, 'create'])->name('operasi.booking.create');
Route::post('/booking-operasi', [BookingOperasiController::class, 'store'])->name('operasi.booking.store');
Route::get('booking-operasi/{id}/edit', [BookingOperasiController::class, 'edit'])->name('operasi.booking.edit');
Route::put('/booking-operasi/{id}', [BookingOperasiController::class, 'update'])->name('operasi.booking.update');
Route::get('booking-operasi/{id}/detail', [BookingOperasiController::class, 'detail'])->name('operasi.booking.detail');

Route::delete('/booking-operasi/delete/{id}', [BookingOperasiController::class, 'destroy'])->name('operasi.booking.destroy');

Route::prefix('ttd-ok')->name('ttd-ok.')->middleware('auth')->group(function () {

    Route::get('tanda-operasi', [TtdTandaOperasiController::class, 'index'])->name('penandaan.index');
    Route::get('create/tanda-operasi', [TtdTandaOperasiController::class, 'create'])->name('penandaan.create');
    Route::get('edit/tanda-operasi/{id}', [TtdTandaOperasiController::class, 'edit'])->name('penandaan.edit');
    Route::post('tanda-operasi', [TtdTandaOperasiController::class, 'store'])->name('penandaan.store');
    Route::put('tanda-operasi/{id}', [TtdTandaOperasiController::class, 'update'])->name('penandaan.update');
    Route::delete('/tanda-operasi/delete/{id}', [TtdTandaOperasiController::class, 'destroy'])->name('penandaan.destroy');
});

Route::put('/booking-operasi/tanggal/{id}', [BookingOperasiController::class, 'updateTanggal'])->name('operasi.tanggal.update');
Route::put('/booking-operasi/ruangan/{id}', [BookingOperasiController::class, 'updateRuangan'])->name('operasi.ruangan.update');
Route::delete('/booking-operasi/delete/{id}', [BookingOperasiController::class, 'destroy'])->name('operasi.booking.destroy');
