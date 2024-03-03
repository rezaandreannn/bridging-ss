<?php

use App\Http\Controllers\AntreanController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\MasterData\Organization;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
// Route::get('/pasien', [PasienController::class, 'index'] ['type_menu' => 'dashboard']);

//  Master Data
// Route::get('/pasien', function () {
//     return view('pages.pasien', ['type_menu' => 'master-data']);
// });

Route::get('/pasien',  [PasienController::class, 'index'])->name('pasien');
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');

// Route::get('/dokter', function () {
//     return view('pages.dokter', ['type_menu' => 'master-data']);
// });

// Kunjungan
// Route::get('/rujukan', function () {
//     return view('pages.rujukan', ['type_menu' => 'kunjungan']);
// });
Route::get('/rujukan', [AntreanController::class, 'index'])->name('rujukan');
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');


// Route::get('testing', function () {
//     $client = Http::get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140')->status();

//     dd($client);
// });
// Route::get('/pendaftaran', function () {
//     return view('pages.pendaftaran', ['type_menu' => 'kunjungan']);
// });

Route::get('test', [PasienController::class, 'index']);

// MASTER DATA 
Route::prefix('md')->group(function () {
    // ORGANIZATION
    Route::get('/organization', [Organization::class, 'index'])->name('organization.index');
    Route::get('/organization/create', [Organization::class, 'create'])->name('organization.create');
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
