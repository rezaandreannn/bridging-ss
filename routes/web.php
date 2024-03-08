<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Kunjungan\AntreanController;
use App\Http\Controllers\MasterData\DokterController;
use App\Http\Controllers\MasterData\PasienController;
use App\Http\Controllers\Kunjungan\PendaftaranController;
use App\Http\Controllers\Mapping\MappingEncounterController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\MasterData\OrganizationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // MASTER DATA 
    Route::prefix('md')->middleware('auth')->group(function () {
        // ORGANIZATION
        Route::get('/organization', [OrganizationController::class, 'index'])->name('organization.index');
        Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organization.create');
        Route::get('/organization/{organization_id}', [OrganizationController::class, 'show'])->name('organization.show');
        Route::get('/organization/{organization_id}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
        Route::post('/organization', [OrganizationController::class, 'store'])->name('organization.store');
        Route::put('/organization{organization_id}', [OrganizationController::class, 'update'])->name('organization.update');

        // PASIEN
        Route::get('/patient', [PasienController::class, 'index'])->name('patient.index');
        Route::get('/patient/create', [PasienController::class, 'create'])->name('patient.create');
        Route::get('/patient/{noMr}', [PasienController::class, 'show'])->name('patient.show');
        Route::post('/patient', [PasienController::class, 'store'])->name('patient.store');

        // DOKTER
        Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
        Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
        Route::get('/dokter/{kode_dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
        Route::get('/dokter/{kode_dokter}', [DokterController::class, 'show'])->name('dokter.show');
    });


    // KUNJUNGAN
    Route::prefix('kj')->group(function () {
        // PENDAFTARAN
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // PASIEN
        Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean.index');
        Route::get('/antrean/{kodeDokter}', [AntreanController::class, 'getByKodeDokter']);
        Route::get('/antrean/create', [AntreanController::class, 'create'])->name('antrean.create');
        Route::post('/antrean', [AntreanController::class, 'store'])->name('antrean.store');
    });


    // mapping data
    Route::prefix('mp')->name('mapping.')->group(function () {
        // Encounter
        Route::get('encounter', [MappingEncounterController::class, 'index'])->name('encounter.index');
        Route::get('encounter/create', [MappingEncounterController::class, 'create'])->name('encounter.create');
    });


    // MANAGE
    Route::prefix('manage')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::put('/user{id}', [UserController::class, 'update'])->name('user.update');
    });



    // credits
    Route::get('/credits', function () {
        return view('pages.forms-advanced-form');
    });
});

require __DIR__ . '/auth.php';
