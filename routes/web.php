<?php

use App\Http\Controllers\Kunjungan\AntreanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterData\DokterController;
use App\Http\Controllers\MasterData\PasienController;
use App\Http\Controllers\Kunjungan\PendaftaranController;
use App\Http\Controllers\MasterData\OrganizationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard-general-dashboard');

// Dashboard
Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});

// Route::get('testing', function () {
//     $client = Http::get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140')->status();

//     dd($client);
// });
// Route::get('/pendaftaran', function () {
//     return view('pages.pendaftaran', ['type_menu' => 'kunjungan']);
// });

// Route::get('test', [PasienController::class, 'index']);

// MASTER DATA 
Route::prefix('md')->group(function () {
    // ORGANIZATION
    Route::get('/organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organization.create');
    Route::get('/organization/{organization_id}', [OrganizationController::class, 'show'])->name('organization.show');
    Route::get('/organization/{organization_id}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::post('/organization', [OrganizationController::class, 'store'])->name('organization.store');
<<<<<<< HEAD
    Route::put('/organization{organization_id}', [OrganizationController::class, 'update'])->name('organization.update');
=======

    // PASIEN
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');

    // DOKTER
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
});

// KUNJUNGAN
Route::prefix('kj')->group(function () {
    // PENDAFTARAN
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // PASIEN
    Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean.index');
    Route::get('/antrean/create', [AntreanController::class, 'create'])->name('antrean.create');
    Route::post('/antrean', [AntreanController::class, 'store'])->name('antrean.store');
>>>>>>> 715e5ebc7f2a4293e838df5db4e820a34c4cd892
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
