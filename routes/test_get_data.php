<?php

use App\Models\Simrs\Ruang;
use App\Models\Simrs\Bangsal;
use App\Models\Simrs\Pendaftaran;
use Illuminate\Support\Facades\Route;
use App\Models\Operasi\BookingOperasi;
use App\Services\Operasi\BookingOperasiService;

Route::prefix('test')->group(function () {
    Route::get('bangsal', function () {
        dd(Bangsal::all());
    });
    Route::get('ruang', function () {
        dd(Ruang::with('bangsal')->limit(1)->get());
    });
    Route::get('pendaftaran/', function () {
        $t = new BookingOperasiService();
        dd($t->byKodeBangsal());
    });
});
