<?php

use App\Models\Simrs\Icd10;
use App\Models\Simrs\Antrean;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Fisio\FisioController;
use App\Http\Controllers\Manage\RoleController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\TandaTanganController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\Rj\RawatJalanController;
use App\Http\Controllers\MasterData\Icd10Controller;
use App\Http\Controllers\Berkas\Berkas_rm_controller;
use App\Http\Controllers\Kunjungan\AntreanController;
use App\Http\Controllers\Manage\PermissionController;
use App\Http\Controllers\MasterData\DokterController;
use App\Http\Controllers\MasterData\PasienController;
use App\Http\Controllers\Encounter\RecourceController;
use App\Http\Controllers\MasterData\LocationController;
use App\Http\Controllers\Kunjungan\PendaftaranController;
use App\Http\Controllers\MasterData\JenisFisioController;
use App\Http\Controllers\MasterData\OrganizationController;
use App\Http\Controllers\Manage\RoleHasPermissionController;
use App\Http\Controllers\Mapping\MappingEncounterController;
use App\Http\Controllers\Fisio\Dokter\AssesmenDokterController;
use App\Http\Controllers\RawatJalan\Perawat\AssesmenController;
use App\Http\Controllers\Case\Encounter\EncounterCreateController;


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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

        // ICD10
        Route::resource('icd10', Icd10Controller::class);

        // Jenis Fisioterapi
        Route::get('/jenisFisio', [JenisFisioController::class, 'index'])->name('jenisFisio.index');
        Route::post('/jenisFisio', [JenisFisioController::class, 'store'])->name('jenisFisio.store');
        Route::put('/jenisFisio/{id}', [JenisFisioController::class, 'update'])->name('jenisFisio.update');
        Route::get('/jenisFisio/{id}', [JenisFisioController::class, 'destroy'])->name('jenisFisio.delete');
    });

    // ENCOUNTER 
    Route::prefix('ss')->group(function () {
        Route::get('/encounter', [RecourceController::class, 'index'])->name('resource.index');
        Route::get('/encounter/{id}/edit', [RecourceController::class, 'edit'])->name('resource.edit');
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
        Route::get('/pendaftaran/{noReg}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');

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
        Route::get('encounter/{id}/edit', [MappingEncounterController::class, 'edit'])->name('encounter.edit');
        Route::get('encounter/create', [MappingEncounterController::class, 'create'])->name('encounter.create');
        Route::post('encounter', [MappingEncounterController::class, 'store'])->name('encounter.store');
        Route::put('/encounter{id}', [MappingEncounterController::class, 'update'])->name('encounter.update');
    });

    Route::prefix('fisioterapi')->group(function () {
        // Fisioterapi
        Route::get('asesmen_pasien', [AssesmenController::class, 'index'])->name('asesmen_pasien.index');
        Route::get('list_pasien', [FisioController::class, 'index'])->name('list-pasien.index');
        Route::get('/transaksi_fisio', [FisioController::class, 'transaksi'])->name('transaksi_fisio.fisio');
        Route::post('/transaksi_fisio', [FisioController::class, 'store'])->name('transaksi_fisio.store');
        Route::put('/transaksi_fisio/{id}', [FisioController::class, 'update'])->name('transaksi_fisio.update');
        Route::get('/transaksi_fisio/{id}', [FisioController::class, 'delete'])->name('transaksi_fisio.delete');

        // Tambah Data CPPT Fisioterapi
        Route::get('/cppt/{id}/{no_mr}/{kode_transaksi}', [FisioController::class, 'detail_cppt'])->name('cppt.detail');
        Route::get('/cppt/tambah/{no_mr}/{kode_transaksi}', [FisioController::class, 'tambah_cppt'])->name('cppt.tambah');
        Route::post('/cppt', [FisioController::class, 'tambahDataCPPT'])->name('cppt.tambahData');
        Route::put('/cppt/{id}', [FisioController::class, 'editDataCPPT'])->name('cppt.updateData');
        Route::get('/cppt/{id}', [FisioController::class, 'deleteDataCPPT'])->name('cppt.deleteData');
        Route::get('edit_cppt/{id}', [FisioController::class, 'edit_cppt'])->name('cppt.edit');

        Route::get('cetak_cppt/{kode_transaksi}/{no_mr}', [FisioController::class, 'cetak_cppt'])->name('cppt.cetakCPPT');
        Route::get('bukti_layanan/{kode_transaksi}/{no_mr}', [FisioController::class, 'bukti_layanan'])->name('cppt.buktiLayanan');

        // Fisioterapi Dokter
        Route::get('dokter/list_pasiens', [AssesmenDokterController::class, 'index'])->name('list_pasiens.dokter');
        Route::get('dokter/assesmen_dokter/{NoMr}', [AssesmenDokterController::class, 'create'])->name('add.dokter');
        Route::get('/form_fisioterapi/{no_mr}', [FisioController::class, 'formDokter'])->name('form.dokter');
        Route::get('/hasil_tindakan/{no_mr}', [FisioController::class, 'tindakanDokter'])->name('tindakan.dokter');
        Route::get('/diagnosa_fisioterapi', [FisioController::class, 'diagnosaDokter'])->name('diagnosa.dokter');
        Route::get('cetak_cppt/{no_mr}', [FisioController::class, 'cetakFormulir'])->name('cppt.cetakFormulir');
    });

    Route::prefix('ttd')->group(function () {
        // Tanda Tangan Petugas
        Route::get('petugas', [TandaTanganController::class, 'index'])->name('list-ttd.index');
        Route::post('petugas', [TandaTanganController::class, 'store'])->name('list-ttd.store');
        Route::get('petugas/edit/{id}', [TandaTanganController::class, 'edit'])->name('list-ttd.edit');
        Route::put('petugas/edit/{id}', [TandaTanganController::class, 'update'])->name('list-ttd.update');
        Route::get('petugas/delete/{id}', [TandaTanganController::class, 'delete'])->name('list-ttd.delete');


        // Tanda Tangan Pasien
        Route::get('/cppt/ttd_pasien/{no_mr}', [TandaTanganController::class, 'ttdPasien'])->name('ttd.pasien');
        Route::get('/cppt/ttd_pasien2/{no_mr}/{kode_dokter}', [TandaTanganController::class, 'ttdPasien2'])->name('ttd.pasien2');
        Route::post('/cppt/ttd_pasien', [TandaTanganController::class, 'ttdPasienStore'])->name('ttd.store');
        Route::post('/cppt/ttd_pasien2', [TandaTanganController::class, 'ttdPasienStore2'])->name('ttd.store2');

        // Edit Tanda Tangan Pasien
        Route::get('/pasienTTD/detail', [TandaTanganController::class, 'ttdPasienDetail'])->name('ttd.pasien.detail');
        Route::get('/pasienTTD/delete/{id}', [TandaTanganController::class, 'deletePasien'])->name('list-ttd-pasien.delete');
        Route::put('/pasienTTD/edit/{id}', [TandaTanganController::class, 'update'])->name('ttd.pasien.update');

        // Tanda Tangan Dokter
        Route::get('/cppt/ttd_dokter', [TandaTanganController::class, 'ttdDokter'])->name('ttd.dokter');
    });

    Route::prefix('rj')->group(function () {
        //Rawat Jalan
        Route::get('rawat_jalan', [AssesmenController::class, 'index'])->name('rj.index');
        Route::get('rawat_jalan/{noReg}', [AssesmenController::class, 'add'])->name('rj.add');
        Route::post('/rawat_jalan', [AssesmenController::class, 'store'])->name('rj.store');
        Route::put('/rawat_jalan/{kode_reg}', [AssesmenController::class, 'update'])->name('rj.update');
        Route::get('rawat_jalan/edit/{noReg}', [AssesmenController::class, 'edit'])->name('rj.edit');
        Route::get('rawat_jalan/resume/{noMR}', [AssesmenController::class, 'resume'])->name('rj.resume');
        Route::get('resumePDF/{noMR}', [AssesmenController::class, 'profilPDF'])->name('rj.cetak');
        Route::get('rawat_jalan/editSKDP/{noReg}', [AssesmenController::class, 'editSKDP'])->name('rj.editSKDP');
        Route::get('skdprencana', [AssesmenController::class, 'skdp_ren_kontrol'])->name('rj.skdp_rencana_kontrol');

        Route::put('rawat_jalan/update_skdp/{noReg}', [AssesmenController::class, 'updateSKDP'])->name('rj.updateSkdp');

        // Report PDF
        Route::get('rawat_jalan/resep/{kode_transaksi}/{noReg}', [Berkas_rm_controller::class, 'cetakResep'])->name('rj.resep');
        Route::get('rawat_jalan/skdp/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakSKDP'])->name('rj.skdp');
        Route::get('rawat_jalan/radiologi/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakRAD'])->name('rj.radiologi');
        Route::get('rawat_jalan/lab/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakLAB'])->name('rj.lab');
        Route::get('rawat_jalan/rujukanRS/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakRujukan'])->name('rj.rujukanRS');
        Route::get('rawat_jalan/rujukanInternal/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakRujukanInternal'])->name('rj.rujukanInternal');
        Route::get('rawat_jalan/prb/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakPRB'])->name('rj.prb');
        Route::get('rawat_jalan/faskes/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakFaskes'])->name('rj.faskes');
    });

    // MANAGE USER
    Route::prefix('mu')->group(function () {
        // USERS
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::put('/user{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

        // ROLES
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::put('/roles{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete');

        // PERMISSION
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::put('/permission{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');

        // ROLE-PERMISSION
        Route::get('/role-permission', [RoleHasPermissionController::class, 'index'])->name('rolepermission.index');
        Route::get('/role-permission/{id}', [RoleHasPermissionController::class, 'getPermission'])->name('rolepermission.edit');
        Route::post('/role-permission/hasPermission', [RoleHasPermissionController::class, 'hasPermission'])->name('rolepermission.postPermission');
    });

    // DOCUMENTATION
    Route::prefix('dc')->group(function () {
        Route::get('/docs-location', [DocumentationController::class, 'location'])->name('docs.location');
        Route::get('/docs-organization', [DocumentationController::class, 'organization'])->name('docs.organization');
        Route::get('/docs-encounter', [DocumentationController::class, 'encounter'])->name('docs.encounter');
    });

    // credits
    Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation.index');
});

Route::get('/server', function () {
    $data = Icd10::all();
    dd($data);
});


require __DIR__ . '/auth.php';
require __DIR__ . '/vclaim.php';
