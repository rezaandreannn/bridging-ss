<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ok\PreOperasiController;
use App\Http\Controllers\Ok\PostOperasiController;
use App\Http\Controllers\Ok\RuangOperasiController;
use App\Http\Controllers\Ok\BerkasPrePostController;
use App\Http\Controllers\OK\JadwalOperasiController;
use App\Http\Controllers\OK\BookingOperasiController;
use App\Http\Controllers\OK\TtdTandaOperasiController;
use App\Http\Controllers\Ok\Medis\ListPasienController;
use App\Http\Controllers\OK\PenandaanOperasiController;
use App\Http\Controllers\OK\MasterData\DoctorController;
use App\Http\Controllers\Ok\Medis\DetailPasienController;
use App\Http\Controllers\Ok\Laporan\LaporanOperasiController;
use App\Http\Controllers\Ok\PraBedah\BerkasPraBedahController;
use App\Http\Controllers\Ok\PraBedah\AssesmenPraBedahController;
use App\Http\Controllers\Ok\ChecklistPembedahan\SignInController;
use App\Http\Controllers\Ok\MasterData\TemplateOperasiController;
use App\Http\Controllers\Ok\ChecklistPembedahan\SignOutController;
use App\Http\Controllers\Ok\PraBedah\VerifikasiPraBedahController;
use App\Http\Controllers\Ok\PascaBedah\PerencanaanPascaBedahController;

Route::prefix('penandaan')->name('operasi.')->middleware('auth')->group(function () {
    // Penandaan Lokasi Operasi
    Route::get('penandaan-operasi', [PenandaanOperasiController::class, 'index'])->name('penandaan.index');
    Route::get('/penandaan-operasi/{noReg}', [PenandaanOperasiController::class, 'create'])->name('penandaan.create');
    Route::post('penandaan-operasi', [PenandaanOperasiController::class, 'store'])->name('penandaan.store');
    Route::get('/penandaan-operasi/{id}/edit', [PenandaanOperasiController::class, 'edit'])->name('penandaan.edit');
    Route::put('/penandaan-operasi/{id}/update', [PenandaanOperasiController::class, 'update'])->name('penandaan.update');
    Route::delete('/penandaan-operasi/delete/{id}', [PenandaanOperasiController::class, 'destroy'])->name('penandaan.destroy');
    Route::get('/penandaan-operasi/cetak/{kode_register}', [PenandaanOperasiController::class, 'cetak'])->name('penandaan.cetak');
});

// Pre Post
Route::prefix('pre-post')->name('operasi.')->middleware('auth')->group(function () {
    // Pre Operasi
    Route::get('/pre-operasi', [PreOperasiController::class, 'index'])->name('pre-operasi.index');
    Route::get('/pre-operasi/create/{kode_register}', [PreOperasiController::class, 'create'])->name('pre-operasi.create');
    Route::post('/pre-operasi', [PreOperasiController::class, 'store'])->name('pre-operasi.store');
    Route::get('/pre-operasi/update/{kode_register}', [PreOperasiController::class, 'edit'])->name('pre-operasi.edit');
    Route::post('/pre-operasi/insertVerifikasiPreOp/{kode_register}', [PreOperasiController::class, 'VerifikasiPreOp'])->name('pre-operasi.Verifikasi-pre-op');
    Route::put('/pre-operasi/update/{kode_register}', [PreOperasiController::class, 'update'])->name('pre-operasi.update');

    // Post Operasi
    Route::get('/post-operasi', [PostOperasiController::class, 'index'])->name('post-operasi.index');
    Route::get('/post-operasi/create/{kode_register}', [PostOperasiController::class, 'create'])->name('post-operasi.create');
    Route::post('/post-operasi', [PostOperasiController::class, 'store'])->name('post-operasi.store');
    Route::get('/post-operasi/update/{kode_register}', [PostOperasiController::class, 'edit'])->name('post-operasi.edit');
    Route::post('/post-operasi/insertVerifikasiPostOp/{kode_register}', [PostOperasiController::class, 'VerifikasiPostOp'])->name('post-operasi.Verifikasi-post-op');
    Route::put('/post-operasi/update/{kode_register}', [PostOperasiController::class, 'update'])->name('post-operasi.update');

    // Berkas Pra Bedah
    Route::get('/berkas-prepost', [BerkasPrePostController::class, 'index'])->name('berkas-prepost.index');
    Route::get('/berkas-prepost/cetak/{kode_register}', [BerkasPrePostController::class, 'cetak'])->name('berkas-prepost.cetak');
    Route::get('/berkas-prepost/show/{kode_register}', [BerkasPrePostController::class, 'show'])->name('berkas-prepost.show');
});


// IBS
Route::prefix('ibs')->name('operasi.')->middleware('auth')->group(function () {
    // jadwal operasi
    Route::get('jadwal-operasi', JadwalOperasiController::class)->name('jadwal.index');

    Route::get('list-pasien', [ListPasienController::class, 'index'])->name('list-pasien.index');
    Route::get('list-pasien-detail/{kodeReg}', [DetailPasienController::class, 'index'])->name('list-pasien-detail.show');

    // OK Ruangan
    Route::get('/ruang-operasi', [RuangOperasiController::class, 'index'])->name('ruang.index');
    Route::post('/ruang-operasi', [RuangOperasiController::class, 'store'])->name('ruang.store');
    Route::put('/ruang-operasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruang.update');
    Route::delete('/ruang-operasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruang.destroy');

    // CheckList Pembedahan Sign In
    Route::get('/checklist-pembedahan-signin', [SignInController::class, 'index'])->name('signin.index');
    Route::get('/checklist-pembedahan-signin/create/{kode_register}', [SignInController::class, 'create'])->name('signin.create');
    Route::post('/checklist-pembedahan-signin', [SignInController::class, 'store'])->name('signin.store');
    Route::get('/checklist-pembedahan-signin/edit/{kode_register}', [SignInController::class, 'edit'])->name('signin.edit');
    Route::put('/checklist-pembedahan-signin/update/{id}', [SignInController::class, 'update'])->name('signin.update');
    // CheckList Pembedahan Sign Out
    Route::get('/checklist-pembedahan-signout', [SignOutController::class, 'index'])->name('signout.index');
    Route::get('/checklist-pembedahan-signout/create/{kode_register}', [SignOutController::class, 'create'])->name('signout.create');
    Route::post('/checklist-pembedahan-signout', [SignOutController::class, 'store'])->name('signout.store');
    Route::get('/checklist-pembedahan-signout/edit/{kode_register}', [SignOutController::class, 'edit'])->name('signout.edit');
    Route::put('/checklist-pembedahan-signout/update/{id}', [SignOutController::class, 'update'])->name('signout.update');

    // jadwal operasi
    Route::get('berkas-operasi', JadwalOperasiController::class)->name('berkas.cetak');

    Route::resource('doctor', DoctorController::class)->except('show');
    Route::get('/doctor/{code}', [DoctorController::class, 'show'])->name('doctor.show');


    // Template Operasi
    Route::get('/template-operasi-Byid', [TemplateOperasiController::class, 'getTemplateByID'])->name('template.macam-operasi');
    Route::get('/template-operasi', [TemplateOperasiController::class, 'index'])->name('template.index');
    Route::post('/template-operasi', [TemplateOperasiController::class, 'store'])->name('template.store');
    Route::post('/doctor/{kodeDokter}/toggle-template', [TemplateOperasiController::class, 'toggle'])->name('doctor.toggle-template');
    Route::put('/template-operasi/update/{id}', [TemplateOperasiController::class, 'update'])->name('template.update');
    Route::delete('/template-operasi/delete/{id}', [TemplateOperasiController::class, 'destroy'])->name('template.destroy');
});

// Prabedah
Route::prefix('prabedah')->name('prabedah.')->middleware('auth')->group(function () {
    // Asesmen Pra Bedah
    Route::get('/assesmen-prabedah', [AssesmenPraBedahController::class, 'index'])->name('assesmen-prabedah.index');
    Route::get('/assesmen-prabedah/create/{kode_register}', [AssesmenPraBedahController::class, 'create'])->name('assesmen-prabedah.create');
    Route::post('/assesmen-prabedah', [AssesmenPraBedahController::class, 'store'])->name('assesmen-prabedah.store');
    Route::get('/assesmen-prabedah/edit/{kode_register}', [AssesmenPraBedahController::class, 'edit'])->name('assesmen-prabedah.edit');
    Route::put('/assesmen-prabedah/update/{kode_register}', [AssesmenPraBedahController::class, 'update'])->name('assesmen-prabedah.update');
    Route::delete('/assesmen-prabedah/delete/{id}', [AssesmenPraBedahController::class, 'destroy'])->name('assesmen-prabedah.destroy');

    // Verifikasi Pra Bedah
    Route::get('/verifikasi-prabedah', [VerifikasiPraBedahController::class, 'index'])->name('verifikasi-prabedah.index');
    Route::get('/verifikasi-prabedah/create/{kode_register}', [VerifikasiPraBedahController::class, 'create'])->name('verifikasi-prabedah.create');
    Route::post('/verifikasi-prabedah', [VerifikasiPraBedahController::class, 'store'])->name('verifikasi-prabedah.store');
    Route::get('/verifikasi-prabedah/edit/{kode_register}', [VerifikasiPraBedahController::class, 'edit'])->name('verifikasi-prabedah.edit');
    Route::put('/verifikasi-prabedah/update/{kode_register}', [VerifikasiPraBedahController::class, 'update'])->name('verifikasi-prabedah.update');
    Route::delete('/verifikasi-prabedah/delete/{id}', [VerifikasiPraBedahController::class, 'destroy'])->name('verifikasi-prabedah.destroy');

    // Berkas Pra Bedah
    Route::get('/berkas-prabedah', [BerkasPraBedahController::class, 'index'])->name('berkas-prabedah.index');
    Route::get('/berkas-prabedah/cetak/{kode_register}', [BerkasPraBedahController::class, 'cetak'])->name('berkas-prabedah.cetak');


    Route::get('/berkas-prabedah/download/{kode_register}', [BerkasPraBedahController::class, 'download'])->name('berkas-prabedah.download');
});

// pasca bedah
Route::prefix('pascabedah')->name('pascabedah.')->middleware('auth')->group(function () {
    // Perencanaan Pasca Bedah
    Route::get('/perencanaan-pascabedah', [PerencanaanPascaBedahController::class, 'index'])->name('perencanaan-pascabedah.index');
    Route::get('/perencanaan-pascabedah/create/{kode_register}', [PerencanaanPascaBedahController::class, 'create'])->name('perencanaan-pascabedah.create');
    Route::post('/perencanaan-pascabedah', [PerencanaanPascaBedahController::class, 'store'])->name('perencanaan-pascabedah.store');
    Route::get('/perencanaan-pascabedah/edit/{kode_register}', [PerencanaanPascaBedahController::class, 'edit'])->name('perencanaan-pascabedah.edit');
    Route::put('/perencanaan-pascabedah/update/{kode_register}', [PerencanaanPascaBedahController::class, 'update'])->name('perencanaan-pascabedah.update');
    Route::delete('/perencanaan-pascabedah/delete/{id}', [PerencanaanPascaBedahController::class, 'destroy'])->name('perencanaan-pascabedah.destroy');
    Route::get('/perencanaan-pascabedah/cetak/{kode_register}', [PerencanaanPascaBedahController::class, 'cetak'])->name('perencanaan-pascabedah.cetak');
    Route::get('/perencanaan-pascabedah/show/{kode_register}', [PerencanaanPascaBedahController::class, 'show'])->name('perencanaan-pascabedah.show');
});

Route::prefix('laporan')->name('laporan.')->middleware('auth')->group(function () {
    Route::get('operasi', [LaporanOperasiController::class, 'index'])->name('operasi.index');
    Route::get('operasi/create/{kode_register}', [LaporanOperasiController::class, 'create'])->name('operasi.create');
    Route::post('operasi', [LaporanOperasiController::class, 'store'])->name('operasi.store');
    Route::get('operasi/edit/{kode_register}', [LaporanOperasiController::class, 'edit'])->name('operasi.edit');
    Route::put('operasi/{kode_register}', [LaporanOperasiController::class, 'update'])->name('operasi.update');
    Route::delete('operasi/{kode_register}', [LaporanOperasiController::class, 'destroy'])->name('operasi.destroy');
    Route::get('operasi/cetak/{kode_register}', [LaporanOperasiController::class, 'cetak'])->name('operasi.cetak');
});

// Pembuka Booking Operasi
Route::get('/booking-operasi', [BookingOperasiController::class, 'index'])->name('operasi.booking.index');
Route::get('/booking-operasi/filter', [BookingOperasiController::class, 'filterBookings']);
Route::get('/booking-operasi/create', [BookingOperasiController::class, 'create'])->name('operasi.booking.create');
Route::post('/booking-operasi', [BookingOperasiController::class, 'store'])->name('operasi.booking.store');
Route::get('booking-operasi/{id}/edit', [BookingOperasiController::class, 'edit'])->name('operasi.booking.edit');
Route::put('/booking-operasi/{id}', [BookingOperasiController::class, 'update'])->name('operasi.booking.update');
Route::get('booking-operasi/{id}/detail', [BookingOperasiController::class, 'detail'])->name('operasi.booking.detail');
Route::delete('/booking-operasi/delete/{id}', [BookingOperasiController::class, 'destroy'])->name('operasi.booking.destroy');
Route::put('/booking-operasi/tanggal/{id}', [BookingOperasiController::class, 'updateTanggal'])->name('operasi.tanggal.update');
Route::put('/booking-operasi/ruangan/{id}', [BookingOperasiController::class, 'updateRuangan'])->name('operasi.ruangan.update');
// Penutup Booking Operasi

Route::prefix('ttd-ok')->name('ttd-ok.')->middleware('auth')->group(function () {
    Route::get('tanda-operasi', [TtdTandaOperasiController::class, 'index'])->name('penandaan.index');
    Route::get('create/tanda-operasi', [TtdTandaOperasiController::class, 'create'])->name('penandaan.create');
    Route::get('edit/tanda-operasi/{id}', [TtdTandaOperasiController::class, 'edit'])->name('penandaan.edit');
    Route::post('tanda-operasi', [TtdTandaOperasiController::class, 'store'])->name('penandaan.store');
    Route::put('tanda-operasi/{id}', [TtdTandaOperasiController::class, 'update'])->name('penandaan.update');
    Route::delete('/tanda-operasi/delete/{id}', [TtdTandaOperasiController::class, 'destroy'])->name('penandaan.destroy');
});
