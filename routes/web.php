<?php

use App\Http\Controllers\Case\Encounter\EncounterCreate;
use App\Http\Controllers\Case\Encounter\EncounterCreateController;
use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Kunjungan\AntreanController;
use App\Http\Controllers\MasterData\DokterController;
use App\Http\Controllers\MasterData\PasienController;
use App\Http\Controllers\Kunjungan\PendaftaranController;
use App\Http\Controllers\Manage\PermissionController;
use App\Http\Controllers\Manage\RoleController;
use App\Http\Controllers\Manage\RoleHasPermissionController;
use App\Http\Controllers\Mapping\MappingEncounterController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\MasterData\LocationController;
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

        // LOCATION
        Route::get('/location', [LocationController::class, 'index'])->name('location.index');
        Route::get('/location/create', [LocationController::class, 'create'])->name('location.create');
        Route::get('/location/{location_id}', [LocationController::class, 'show'])->name('location.show');
        Route::get('/location/{location_id}/edit', [LocationController::class, 'edit'])->name('location.edit');
        Route::post('/location', [LocationController::class, 'store'])->name('location.store');
        Route::patch('/location/{location_id}', [LocationController::class, 'update'])->name('location.update');
    });

    // CASE 
    Route::prefix('case')->name('case.')->group(function () {
        Route::get('encounter/create/{noReg}', EncounterCreateController::class)->name('encounter.create');
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


    // MAPPING DATA
    Route::prefix('mp')->name('mapping.')->group(function () {
        // ENCOUNTER
        Route::get('encounter', [MappingEncounterController::class, 'index'])->name('encounter.index');
        Route::get('encounter/create', [MappingEncounterController::class, 'create'])->name('encounter.create');
        Route::post('encounter', [MappingEncounterController::class, 'store'])->name('encounter.store');
    });

    // DOCUMENTATION
    Route::prefix('dc')->group(function () {
        // ENCOUNTER
        Route::get('/docs-location', [DocumentationController::class, 'location'])->name('docs.location');
        Route::get('/docs-organization', [DocumentationController::class, 'organization'])->name('docs.organization');
        Route::get('/docs-encounter', [DocumentationController::class, 'encounter'])->name('docs.encounter');
    });


    // MANAGE USER
    Route::prefix('mu')->middleware('auth')->group(function () {

        // USERS
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::put('/user{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

        // ROLES
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::put('/role{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');

        // PERMISSION
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::put('/permission{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');

        // ROLE-PERMISSION
        Route::get('/role-permission', [RoleHasPermissionController::class, 'index'])->name('role-permission.index');
        Route::get('/role-permission/{id}', [RoleHasPermissionController::class, 'getPermission'])->name('role-permission.edit');
        Route::post('/role-permission/hasPermission', [RoleHasPermissionController::class, 'hasPermission'])->name('rolePermission.postPermission');
    });



    // credits
    Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation.index');
});

require __DIR__ . '/auth.php';
