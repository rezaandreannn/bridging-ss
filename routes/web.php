<?php

use App\Models\Fisioterapi;
use App\Models\Simrs\Icd10;
use App\Models\Simrs\Antrean;
use App\Models\Simrs\Pendaftaran;
use App\Models\Simrs\TrBiayaRinci;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\igd\TriaseController;
use App\Http\Controllers\Fisio\FisioController;
use App\Http\Controllers\Manage\RoleController;
use App\Http\Controllers\Manage\UserController;
use App\Http\Controllers\TandaTanganController;
use App\Services\Operasi\BookingOperasiService;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\Rj\RawatJalanController;
use App\Http\Controllers\IGD\Layanan\EwsController;
use App\Http\Controllers\Ok\RuangOperasiController;
use App\Http\Controllers\MasterData\Icd10Controller;
use App\Http\Controllers\Berkas\Berkas_rm_controller;
use App\Http\Controllers\Kunjungan\AntreanController;
use App\Http\Controllers\Manage\PermissionController;
use App\Http\Controllers\MasterData\DokterController;
use App\Http\Controllers\MasterData\PasienController;
use App\Http\Controllers\OK\BookingOperasiController;
use App\Http\Controllers\Berkas\Surat\SuratController;
use App\Http\Controllers\Encounter\RecourceController;
use App\Http\Controllers\Farmasi\OrderAlkesController;
use App\Http\Controllers\Berkas\klaim\ResumeController;
use App\Http\Controllers\Berkas\Ranap\BerkasController;
use App\Http\Controllers\MasterData\LocationController;
use App\Http\Controllers\OK\PenandaanOperasiController;
use App\Http\Controllers\RawatInap\Cppt\CpptController;
use App\Http\Controllers\IGD\Layanan\SkriningController;
use App\Http\Controllers\MasterData\TtdDokterController;
use App\Http\Controllers\Fisio\InformedConcentController;
use App\Http\Controllers\Kunjungan\PendaftaranController;
use App\Http\Controllers\MasterData\JenisFisioController;
use App\Http\Controllers\MasterData\TtdPerawatController;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;
use App\Http\Controllers\Farmasi\MasterDataAlkesController;
use App\Http\Controllers\MasterData\OrganizationController;
use App\Http\Controllers\profileUser\ProfileUserController;
use App\Http\Controllers\Berkas\igd\RekamMedisIgdController;
use App\Http\Controllers\Fisio\Berkas\BerkasFisioController;
use App\Http\Controllers\Manage\RoleHasPermissionController;
use App\Http\Controllers\Mapping\MappingEncounterController;
use App\Http\Controllers\RiwayatMedis\BerkasMedisController;
use App\Http\Controllers\RiwayatMedis\BerkasOperasiController;
use App\Http\Controllers\Fisio\Dokter\AssesmenDokterController;
use App\Http\Controllers\Fisio\MasterData\KesimpulanController;
use App\Http\Controllers\RawatJalan\Perawat\AssesmenController;
use App\Http\Controllers\RawatInap\Detail\BerkasRanapController;
use App\Http\Controllers\RawatInap\Detail\DetailRanapController;
use App\Http\Controllers\RawatInap\Dokter\RanapDokterController;
use App\Http\Controllers\RawatJalan\Dokter\RajalDokterController;
use App\Http\Controllers\Case\Encounter\EncounterCreateController;
use App\Http\Controllers\Poli\Mata\Perawat\AssesmenMataController;
use App\Http\Controllers\Fisio\MasterData\DiagnosisMedisController;
use App\Http\Controllers\PetugasKoding\Rajal\KodingRajalController;
use App\Http\Controllers\RawatJalan\Dokter\KondisiPulangController;
use App\Http\Controllers\Fisio\MasterData\DiagnosisFungsiController;
use App\Http\Controllers\Poli\Mata\Dokter\AssesmenDokterMataController;
use App\Http\Controllers\Poli\Mata\MasterData\PenyakitSekarangController;
use App\Http\Controllers\Berkas\Rekam_medis_by_mr\RekamMedisByMrController;
use App\Http\Controllers\Berkas\Rekam_medis_harian\RekamMedisHarianController;
use App\Http\Controllers\IGD\Layanan\AssesmenController as LayananAssesmenController;

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
    Route::get('riwayat-medis/operasi', [BerkasOperasiController::class, 'index'])->name('berkas-operasi.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile user
    Route::prefix('profile')->group(function () {
        // ENCOUNTER
        Route::get('biodata', [ProfileUserController::class, 'index'])->name('biodata.index');

        Route::get('password', [ProfileUserController::class, 'showEditPassword'])->name('password.index');
        Route::post('password/update', [ProfileUserController::class, 'passwordUpdate'])->name('password.updated');
    });

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

        // Jenis Fisioterapi (Master Data)
        Route::get('/jenisFisio', [JenisFisioController::class, 'index'])->name('jenisFisio.index');
        Route::post('/jenisFisio', [JenisFisioController::class, 'store'])->name('jenisFisio.store');
        Route::put('/jenisFisio/{id}', [JenisFisioController::class, 'update'])->name('jenisFisio.update');
        Route::delete('/jenisFisio/{id}', [JenisFisioController::class, 'destroy'])->name('jenisFisio.delete');

        // master data farmasi
        Route::get('farmasi', [MasterDataAlkesController::class, 'index'])->name('masterData.index');

        Route::post('farmasi/alkes/add_proses', [MasterDataAlkesController::class, 'store'])->name('masterAlkes.store');

        Route::put('farmasi/alkes/update_proses/{id}', [MasterDataAlkesController::class, 'update'])->name('masterAlkes.update');

        Route::delete('farmasi/alkes/delete_proses/{id}', [MasterDataAlkesController::class, 'destroy'])->name('masterAlkes.destroy');

        Route::post('farmasi/harga_alkes/add_proses', [MasterDataAlkesController::class, 'store_harga'])->name('masterHargaAlkes.store');
        Route::put('farmasi/harga_alkes/update_proses/{id}', [MasterDataAlkesController::class, 'update_harga'])->name('masterHargaAlkes.update');
        Route::delete('farmasi/harga_alkes/delete_proses/{id}', [MasterDataAlkesController::class, 'destroy_harga'])->name('masterHargaAlkes.destroy');

        Route::get('ttd-dokter', [TtdDokterController::class, 'index'])->name('ttd-dokter.index');
        Route::get('ttd-dokter/create', [TtdDokterController::class, 'create'])->name('ttd-dokter.create');
        Route::get('ttd-dokter/edit/{id}', [TtdDokterController::class, 'edit'])->name('ttd-dokter.edit');
        Route::post('ttd-dokter', [TtdDokterController::class, 'store'])->name('ttd-dokter.store');
        Route::put('ttd-dokter/{id}/update', [TtdDokterController::class, 'update'])->name('ttd-dokter.update');
        Route::delete('ttd-dokter/delete/{id}', [TtdDokterController::class, 'destroy'])->name('ttd-dokter.destroy');

        Route::get('ttd-perawat', [TtdPerawatController::class, 'index'])->name('ttd-perawat.index');
        Route::delete('ttd-perawat/delete/{id}', [TtdPerawatController::class, 'destroy'])->name('ttd-perawat.destroy');
        Route::get('ttd-perawat/create', [TtdPerawatController::class, 'create'])->name('ttd-perawat.create');
        Route::get('ttd-perawat/edit/{id}', [TtdPerawatController::class, 'edit'])->name('ttd-perawat.edit');
        Route::post('ttd-perawat', [TtdPerawatController::class, 'store'])->name('ttd-perawat.store');
        Route::put('ttd-perawat/{id}/update', [TtdPerawatController::class, 'update'])->name('ttd-perawat.update');
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
        Route::get('/antrean/create', [AntreanController::class, 'create'])->name('antrean.create');
        Route::post('/antrean', [AntreanController::class, 'store'])->name('antrean.store');
        Route::get('/antrean/{no_mr}', [AntreanController::class, 'show'])->name('antrean.show');
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


    Route::prefix('farmasi')->group(function () {
        // ENCOUNTER
        Route::get('orderAlkes', [OrderAlkesController::class, 'index'])->name('orderAlkes.index');
        Route::get('orderAlkes/verifByFarmasi', [OrderAlkesController::class, 'harga_alkes_by_ukuran_alat'])->name('orderAlkes.verifFarmasi');


        Route::get('orderAlkes/cetakResepAlkes/{noReg}', [Berkas_rm_controller::class, 'cetakResepAlkes'])->name('rj.alkes');

        Route::get('orderAlkes/cetakKwitansiAlkes/{noReg}', [Berkas_rm_controller::class, 'cetakKwitansiAlkes'])->name('orderAlkes.Kwitansi');
    });

    Route::prefix('surat')->group(function () {
        Route::get('medis', [SuratController::class, 'index'])->name('surat.index');
        // Surat Sakit
        Route::get('medis/suratSakit/{noReg}', [SuratController::class, 'addSuratSakit'])->name('add.suratSakit');
        Route::post('medis/suratSakit/', [SuratController::class, 'suratSakitStore'])->name('store.suratSakit');
        Route::get('medis/suratSakit/edit/{noReg}', [SuratController::class, 'editSuratSakit'])->name('edit.suratSakit');
        Route::put('medis/suratSakit/edit/{noReg}', [SuratController::class, 'updateSuratSakit'])->name('update.suratSakit');
        Route::get('medis/cetakSuratSakit/{noReg}', [SuratController::class, 'cetakSuratSakit'])->name('cetak.suratSakit');
        // Surat Keterangan Dokter
        Route::get('medis/SKD/{noReg}', [SuratController::class, 'addSkd'])->name('add.SKD');
        Route::post('medis/SKD/', [SuratController::class, 'SkdStore'])->name('store.SKD');
        Route::get('medis/SKD/edit/{noReg}', [SuratController::class, 'editSkd'])->name('edit.SKD');
        Route::put('medis/SKD/edit/{noReg}', [SuratController::class, 'updateSkd'])->name('update.SKD');
        Route::get('medis/cetakSKD/{noReg}', [SuratController::class, 'cetakSkd'])->name('cetak.SKD');
    });

    Route::prefix('fisioterapi')->group(function () {
        // Fisioterapi
        Route::get('asesmen_pasien', [AssesmenController::class, 'index'])->name('asesmen_pasien.index');
        Route::get('perawat/list_pasien', [FisioController::class, 'index'])->name('list-pasien.index');
        Route::get('perawat/transaksi_fisio', [FisioController::class, 'transaksi'])->name('transaksi_fisio.fisio');
        Route::post('perawat/transaksi_fisio/add', [FisioController::class, 'store'])->name('transaksi_fisio.store');
        Route::get('perawat/transaksi_fisio/addtindakan', [FisioController::class, 'storeTindakan'])->name('transaksi_fisio.addtindakan');
        Route::put('perawat/transaksi_fisio/editAlkesByFisioterapi', [FisioController::class, 'update_alkes'])->name('transaksi_fisio.update_alkes');

        Route::put('perawat/transaksi_fisio/editAlkesByBpjs', [FisioController::class, 'update_alkes_bpjs'])->name('transaksi_fisio.update_alkes_bpjs');

        Route::put('perawat/transaksi_fisio/editAlkesByFarmasi', [FisioController::class, 'update_alkes_farmasi'])->name('transaksi_fisio.update_alkes_farmasi');

        Route::put('perawat/transaksi_fisio/{id}', [FisioController::class, 'update'])->name('transaksi_fisio.update');
        Route::delete('perawat/transaksi_fisio/{id}', [FisioController::class, 'delete'])->name('transaksi_fisio.delete');

        // Tambah Data CPPT Fisioterapi
        Route::get('perawat/cppt/{id}/{no_mr}/{kode_transaksi}', [FisioController::class, 'detail_cppt'])->name('cppt.detail');
        Route::get('perawat/cppt/tambah/{no_mr}/{kode_transaksi}', [FisioController::class, 'tambah_cppt'])->name('cppt.tambah');
        Route::post('perawat/cppt', [FisioController::class, 'tambahDataCPPT'])->name('cppt.tambahData');
        Route::delete('perawat/cppt/{id}', [FisioController::class, 'deleteDataCPPT'])->name('cppt.deleteData');
        Route::get('perawat/edit_cppt/{id}', [FisioController::class, 'edit_cppt'])->name('cppt.edit');

        Route::get('perawat/edit_cppt_riwayat/{id}', [FisioController::class, 'edit_cppt_riwayat'])->name('cppt.editRiwayat');
        Route::put('perawat/cppt/{id}', [FisioController::class, 'editDataCPPT'])->name('cppt.updateData');
        Route::put('perawat/cppt_riwayat/{id}', [FisioController::class, 'editDataRiwayatCPPT'])->name('cppt.updateRiwayatCppt');

        Route::get('cetak_cppt/{kode_transaksi}/{no_mr}', [FisioController::class, 'cetak_cppt'])->name('cppt.cetakCPPT');
        Route::get('cetak_cppt_riwayat/{no_reg}/{no_mr}', [FisioController::class, 'cetak_cppt_riwayat'])->name('cppt.cetakCpptRiwayat');

        Route::get('bukti_layanan/{kode_transaksi}/{no_mr}', [FisioController::class, 'bukti_layanan'])->name('cppt.buktiLayanan');

        // Fisioterapi Dokter
        Route::get('dokter/list_pasiens', [AssesmenDokterController::class, 'index'])->name('list_pasiens.dokter');
        Route::get('dokter/assesmen_dokter/{NoMr}', [AssesmenDokterController::class, 'create'])->name('add.dokter');

        // riwayat fisioterapi berdasarkan tanggal
        Route::get('dokter/riwayat_pasien', [AssesmenDokterController::class, 'riwayat_pemeriksaan_fisio'])->name('riwayatFisio.dokter');
        // riwayat fisioterapi berdasarkan tanggal
        Route::get('dokter/riwayat_pemeriksaan_pasien', [RekamMedisHarianController::class, 'riwayat_pemeriksaan_pasien'])->name('riwayatPemeriksaanPasien.dokter');

        // dokter copy riwayat
        Route::get('dokter/list_pasiens/assesmen_dokter2/copy/{noMr}/{noRegBaru}/{noRegLama}', [AssesmenDokterController::class, 'copy_riwayat'])->name('fisio.copyRiwayat');
        // dokter add
        Route::get('dokter/list_pasiens/assesmen_fisio2/{NoMr}/{noReg}', [AssesmenDokterController::class, 'create_new'])->name('add.dokterNew');
        Route::get('dokter/assesmen_fisio/edit/{NoMr}/{noReg}', [AssesmenDokterController::class, 'editAsesmen'])->name('edit_asesmen.dokter');
        Route::get('dokter/riwayat_pasien/assesmen_fisio/edit/{NoMr}/{noReg}', [AssesmenDokterController::class, 'editRiwayatAsesmen'])->name('edit_riwayat_asesmen.dokter');

        Route::post('dokter/assesmen_fisio/add', [AssesmenDokterController::class, 'store'])->name('asesmenStore.dokter');

        Route::post('dokter/assesmen_fisio/add2', [AssesmenDokterController::class, 'store_new'])->name('asesmenStore.dokterNew');

        Route::put('dokter/assesmen_fisio/update', [AssesmenDokterController::class, 'update'])->name('asesmenUpdate.dokter');
        Route::put('dokter/riwayat_assesmen_fisio/update', [AssesmenDokterController::class, 'riwayatFisioupdate'])->name('asesmenRiwayatUpdate.dokter');

        // uji fungsi
        Route::get('dokter/lembar_uji_fungsi/{NoMr}', [AssesmenDokterController::class, 'createUjiFungsi'])->name('add.ujifungsi');
        Route::get('dokter/lembar_uji_fungsi/edit/{NoMr}', [AssesmenDokterController::class, 'editUjiFungsi'])->name('edit.ujifungsi');
        Route::post('dokter/lembar_uji_fungsi/add', [AssesmenDokterController::class, 'storeUjiFungsi'])->name('store.ujiFungsi');
        Route::put('dokter/lembar_uji_fungsi/update', [AssesmenDokterController::class, 'updateUjiFungsi'])->name('update.ujiFungsi');

        // lembar spkfr
        Route::get('dokter/lembar_spkfr/{NoMr}', [AssesmenDokterController::class, 'lembarSpkfr'])->name('add.spkfr');
        Route::get('dokter/lembar_spkfr/edit/{NoMr}', [AssesmenDokterController::class, 'editLembarSpkfr'])->name('edit.lembarspkfr');
        Route::post('dokter/lembar_spkfr/add', [AssesmenDokterController::class, 'storeSpkfr'])->name('store.spkfr');
        Route::put('dokter/lembar_spkfr/update', [AssesmenDokterController::class, 'updateSpkfr'])->name('update.spkfr');


        Route::get('/form_fisioterapi/{no_mr}', [FisioController::class, 'formDokter'])->name('form.dokter');

        Route::get('/hasil_tindakan/{no_mr}', [FisioController::class, 'tindakanDokter'])->name('tindakan.dokter');
        Route::get('/diagnosa_fisioterapi', [FisioController::class, 'diagnosaDokter'])->name('diagnosa.dokter');
        Route::get('cetak_cppt/{no_mr}', [FisioController::class, 'cetakFormulir'])->name('cppt.cetakFormulir');



        // informed concent
        Route::get('informed_concent/list_pasien', [InformedConcentController::class, 'index'])->name('informed_concent.index');
        Route::get('informed_concent/add', [InformedConcentController::class, 'create'])->name('informed_concent.add');
        Route::post('informed_concent/add_proses', [InformedConcentController::class, 'store'])->name('informed_concent.add_proses');
        Route::get('informed_concent/dokter/{noReg}', [InformedConcentController::class, 'cetakPersetujuan'])->name('informed_concent.cetakPersetujuan');
        Route::get('rujukan/add', [InformedConcentController::class, 'create_rujukan'])->name('rujukan.add');

        // rujukan fisioterapi
        Route::get('rujukan/add', [InformedConcentController::class, 'create_rujukan'])->name('rujukan.add');
        Route::post('rujukan/add', [InformedConcentController::class, 'store_rujukan'])->name('rujukan.store');

        // diagnosis medis
        Route::get('master_data/diagnosis_medis/list', [DiagnosisMedisController::class, 'index'])->name('diagnosisMedis.index');
        Route::post('master_data/diagnosis_medis/add_proses', [DiagnosisMedisController::class, 'store'])->name('diagnosisMedis.store');
        Route::put('master_data/diagnosis_medis/update_proses/{id}', [DiagnosisMedisController::class, 'update'])->name('diagnosisMedis.update');
        Route::delete('master_data/diagnosis_medis/delete_proses/{id}', [DiagnosisMedisController::class, 'destroy'])->name('diagnosisMedis.destroy');

        // diagnosis fungsi
        Route::get('master_data/diagnosis_fungsi/list', [DiagnosisFungsiController::class, 'index'])->name('diagnosisFungsi.index');
        Route::post('master_data/diagnosis_fungsi/add_proses', [DiagnosisFungsiController::class, 'store'])->name('diagnosisFungsi.store');

        Route::put('master_data/diagnosis_fungsi/update_proses/{id}', [DiagnosisFungsiController::class, 'update'])->name('diagnosisFungsi.update');
        Route::delete('master_data/diagnosis_fungsi/delete_proses/{id}', [DiagnosisFungsiController::class, 'destroy'])->name('diagnosisFungsi.destroy');

        // kesimpulan
        Route::get('master_data/kesimpulan/list', [KesimpulanController::class, 'index'])->name('kesimpulan.index');
        Route::post('master_data/kesimpulan/add_proses', [KesimpulanController::class, 'store'])->name('kesimpulan.store');
        Route::put('master_data/kesimpulan/update_proses/{id}', [KesimpulanController::class, 'update'])->name('kesimpulan.update');
        Route::delete('master_data/kesimpulan/delete_proses/{id}', [KesimpulanController::class, 'destroy'])->name('kesimpulan.destroy');
    });

    // Berkas Rekam Medis
    Route::prefix('berkas')->group(function () {
        Route::get('berkas_fisio', [BerkasFisioController::class, 'index'])->name('berkas.fisio');
        Route::get('berkas_fisio/cetak_rm_dokter/{no_reg}', [BerkasFisioController::class, 'cetak_rm_dokter'])->name('berkas.cetakRmFisio');
        Route::get('berkas_fisio/cppt/{no_mr}/{no_reg}', [BerkasFisioController::class, 'cppt_list'])->name('berkas.cppt');
        Route::get('berkas_fisio/rujukan', [BerkasFisioController::class, 'cetak_rujukan'])->name('berkas.rujukan');
        Route::get('berkas_fisio/informed', [BerkasFisioController::class, 'cetak_informed'])->name('berkas.informed');
        Route::get('/berkas_fisio/harian', [BerkasFisioController::class, 'berkas'])->name('berkas.harian');

        // fisioterapi berdasarkan pelayanan dr bastian
        Route::get('berkas_fisio/detail_fisioterapi/{no_reg}', [BerkasFisioController::class, 'getFisioterapiDetailByDokter'])->name('berkas.detail_fisioterapi');

        // Bukti Pelayanan Alat Kesehatan
        Route::get('berkas_fisio/pelayanan_alat/{no_reg}', [BerkasFisioController::class, 'buktiPelayananOrderAlkes'])->name('berkas.alat');
    });

    // Poli Mata
    Route::prefix('pm')->group(function () {
        // Poli Mata Perawat
        Route::get('/polimata/perawat', [AssesmenMataController::class, 'index'])->name('poliMata.index');
        Route::post('/polimata/perawat', [AssesmenMataController::class, 'store'])->name('poliMata.store');
        // Cetak Berkas
        Route::get('/polimata/perawat/resep/{kode_transaksi}/{noReg}', [AssesmenMataController::class, 'cetakResep'])->name('polimata.resep');
        Route::get('/polimata/perawat/cetak_rm/{noReg}', [AssesmenMataController::class, 'cetakRM'])->name('polimata.cetakRM');
        Route::get('/polimata/perawat/konsul/cetak_rm/{noReg}', [AssesmenMataController::class, 'cetakRMKonsul'])->name('polimata.cetakRMKonsul');
        Route::get('/polimata/perawat/cetak_resume/{noReg}', [AssesmenMataController::class, 'cetakResume'])->name('polimata.cetakResume');
        Route::get('/polimata/perawat/cetak_skdp/{kode_transaksi}/{noReg}', [AssesmenMataController::class, 'cetakSKDP'])->name('polimata.cetakSKDP');
        Route::get('/polimata/perawat/rujukanRS/{kode_transaksi}/{noReg}', [AssesmenMataController::class, 'cetakRujukRS'])->name('polimata.cetakRujukanRS');
        Route::get('/polimata/perawat/rujukanInternal/{kode_transaksi}/{noReg}', [AssesmenMataController::class, 'cetakRujukanInternal'])->name('polimata.cetakRujukanInternal');
        Route::get('/polimata/perawat/assesmen_keperawatan/{noReg}', [AssesmenMataController::class, 'Add'])->name('poliMata.assesmenKeperawatanAdd');
        Route::get('/polimata/perawat/assesmen_keperawatan/edit/{noReg}', [AssesmenMataController::class, 'Edit'])->name('poliMata.assesmenKeperawatanEdit');
        Route::put('/polimata/perawat/assesmen_keperawatan/edit/{noReg}', [AssesmenMataController::class, 'update'])->name('poliMata.assesmenKeperawatanUpdate');
        // Refraksi Optisi
        Route::get('/polimata/refraksi', [AssesmenMataController::class, 'refraksi'])->name('poliMata.refraksi');
        Route::post('/polimata/refraksi', [AssesmenMataController::class, 'refraksiStore'])->name('poliMata.refraksiStore');
        Route::put('/polimata/refraksi/{noReg}', [AssesmenMataController::class, 'refraksiUpdate'])->name('poliMata.refraksiUpdate');

        // Poli Mata Dokter
        Route::get('/polimata/dokter', [AssesmenDokterMataController::class, 'index'])->name('poliMata.indexDokter');
        Route::get('/polimata/dokter/assesmen_awal/{noReg}/{NoMr}', [AssesmenDokterMataController::class, 'add'])->name('poliMata.assesmenAwal');
        Route::get('/polimata/dokter/konsul/{noReg}', [AssesmenDokterMataController::class, 'konsul'])->name('poliMata.Konsul');
        Route::post('/polimata/dokter/assesmen_awal', [AssesmenDokterMataController::class, 'store'])->name('poliMata.assesmenAwalStore');
        Route::get('polimata/dokter/assesmen_awal/edit{noReg}', [AssesmenDokterMataController::class, 'edit'])->name('poliMata.assesmenAwalEdit');
        Route::put('/polimata/dokter/assesmen_awal/edit_process/{noReg}', [AssesmenDokterMataController::class, 'update'])->name('poliMata.assesmenAwalUpdate');
        // Route::get('/polimata/dokter/assesmen_mata/{noReg}', [AssesmenMataController::class, 'assesmenMata'])->name('poliMata.assesmenMata');

        // Copy Riwayat Poli Mata
        Route::get('polimata/dokter/assesmen_dokter/copy/{noMr}/{noRegBaru}/{noRegLama}', [AssesmenDokterMataController::class, 'copy_riwayat'])->name('poliMata.copyRiwayat');


        // Assesmen Lama
        Route::get('/polimata/Assesmen_keperawatan2', [AssesmenMataController::class, 'index2'])->name('poliMata.index2');
        Route::get('/polimata/dokter2', [AssesmenDokterMataController::class, 'index2'])->name('poliMata.indexDokter2');
        // Berkas Riwayat Rekam Medis
        Route::get('/berkasPoliMata/riwayatRekamMedis', [AssesmenMataController::class, 'berkas'])->name('poliMata.rekamMedis');
        // Master Data
        // diagnosis fungsi
        Route::get('master_data/penyakit_sekarang/list', [PenyakitSekarangController::class, 'index'])->name('penyakitSekarang.index');
        Route::post('master_data/penyakit_sekarang/add_proses', [PenyakitSekarangController::class, 'store'])->name('penyakitSekarang.store');
        Route::put('master_data/penyakit_sekarang/update_proses/{id}', [PenyakitSekarangController::class, 'update'])->name('penyakitSekarang.update');
        Route::delete('master_data/penyakit_sekarang/delete_proses/{id}', [PenyakitSekarangController::class, 'destroy'])->name('penyakitSekarang.destroy');
    });

    Route::prefix('ttd')->group(function () {
        // Tanda Tangan Petugas
        Route::get('petugasTtd', [TandaTanganController::class, 'index'])->name('list-ttd.index');
        Route::post('petugasTtd', [TandaTanganController::class, 'store'])->name('list-ttd.store');
        Route::get('petugasTtd/edit/{id}', [TandaTanganController::class, 'edit'])->name('list-ttd.edit');
        Route::put('petugasTtd/edit/{id}', [TandaTanganController::class, 'update'])->name('list-ttd.update');
        Route::delete('petugasTtd/delete/{id}', [TandaTanganController::class, 'delete'])->name('list-ttd.delete');


        // Tanda Tangan Pasien
        Route::get('/cppt/ttd_pasien/{no_mr}', [TandaTanganController::class, 'ttdPasien'])->name('ttd.pasien');
        Route::get('/cppt/ttd_pasien2/{no_mr}/{kode_dokter}', [TandaTanganController::class, 'ttdPasien2'])->name('ttd.pasien2');
        Route::post('/cppt/ttd_pasien', [TandaTanganController::class, 'ttdPasienStore'])->name('ttd.store');
        Route::post('/cppt/ttd_pasien2', [TandaTanganController::class, 'ttdPasienStore2'])->name('ttd.store2');

        // Edit Tanda Tangan Pasien
        Route::get('pasienTtd/detail', [TandaTanganController::class, 'ttdPasienDetail'])->name('ttd.pasien.detail');
        Route::delete('pasienTtd/delete/{id}', [TandaTanganController::class, 'deletePasien'])->name('list-ttd-pasien.delete');
        Route::put('pasienTtd/edit/{id}', [TandaTanganController::class, 'update'])->name('ttd.pasien.update');
        Route::get('pasienTtd/byPetugas/', [TandaTanganController::class, 'ttdPasienBypetugas'])->name('ttd.pasien.bypetugas');
        Route::post('/cppt/ttd_pasienbypetugas', [TandaTanganController::class, 'ttdPasienStoreByPetugas'])->name('ttd.storebypetugas');

        // Tanda Tangan Dokter
        Route::get('/cppt/ttd_dokter', [TandaTanganController::class, 'ttdDokter'])->name('ttd.dokter');
    });


    // Rawat Jalan Perawat
    Route::prefix('rj')->group(function () {
        //Rawat Jalan Perawat
        Route::get('rawat_jalan', [AssesmenController::class, 'index'])->name('rj.index');
        Route::get('rawat_jalan/{noReg}', [AssesmenController::class, 'add'])->name('rj.add');
        Route::post('/rawat_jalan', [AssesmenController::class, 'store'])->name('rj.store');
        Route::put('/rawat_jalan/{kode_reg}', [AssesmenController::class, 'update'])->name('rj.update');
        Route::get('rawat_jalan/edit/{noReg}', [AssesmenController::class, 'edit'])->name('rj.edit');
        Route::get('rawat_jalan/resume/{noMR}', [AssesmenController::class, 'resume'])->name('rj.resume');
        Route::get('rawat_jalan/history/{noMR}', [AssesmenController::class, 'history'])->name('rj.history');
        Route::get('resumePDF/{noMR}', [AssesmenController::class, 'profilPDF'])->name('rj.cetak');
        Route::get('rawat_jalan/editSKDP/{noReg}', [AssesmenController::class, 'editSKDP'])->name('rj.editSKDP');
        Route::get('skdprencana', [AssesmenController::class, 'skdp_ren_kontrol'])->name('rj.skdp_rencana_kontrol');

        Route::put('rawat_jalan/update_skdp/{noReg}', [AssesmenController::class, 'updateSKDP'])->name('rj.updateSkdp');

        // Report PDF
        Route::get('rawat_jalan/resep/{kode_transaksi}/{noReg}', [Berkas_rm_controller::class, 'cetakResep'])->name('rj.resep');


        Route::get('rawat_jalan/skdp/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakSKDP'])->name('rj.skdp');
        Route::get('rawat_jalan/radiologi/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakRAD'])->name('rj.radiologi');
        Route::get('rawat_jalan/lab/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakLAB'])->name('rj.lab');
        Route::get('rawat_jalan/rujukanRS/{noReg}/{kode_transaksi}/{id_surat}', [Berkas_rm_controller::class, 'cetakRujukan'])->name('rj.rujukanRS');
        Route::get('rawat_jalan/rujukanInternal/{noReg}/{kode_transaksi}/{id_surat}', [Berkas_rm_controller::class, 'cetakRujukanInternal'])->name('rj.rujukanInternal');
        Route::get('rawat_jalan/prb/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakPRB'])->name('rj.prb');
        Route::get('rawat_jalan/faskes/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakFaskes'])->name('rj.faskes');
        Route::get('rawat_jalan/hasil_echo/{noReg}/{kode_transaksi}', [Berkas_rm_controller::class, 'cetakHasilEcho'])->name('rj.hasilEcho');
        // Report Rekam Medis Rawat Jalan
        Route::get('rawat_jalan/cetak_rm/{noReg}/{noMR}', [Berkas_rm_controller::class, 'cetakRM'])->name('rj.rmDokter');





        // Rawat Jalan Dokter
        Route::get('rajal/dokter/', [RajalDokterController::class, 'index'])->name('rj.dokter');
        Route::get('rajal/dokter/add_asesmen/{noReg}/{noMR}', [RajalDokterController::class, 'createAsesmen'])->name('rj.dokterHistory');
        Route::post('rajal/dokter/add_asesmen/add_process', [RajalDokterController::class, 'store'])->name('rj.storeDokter');
        Route::get('rajal/dokter/copy_asesmen/{noReg}/{noMR}', [RajalDokterController::class, 'copyDokter'])->name('rj.dokterCopy');
        Route::get('rajal/dokter/detail/{noReg}/{noMR}', [RajalDokterController::class, 'detailDokter'])->name('rj.dokterDetail');

        Route::get('rajal/dokter/resep/{noReg}', [RajalDokterController::class, 'resepDokter'])->name('rj.dokterResep');
        Route::get('rajal/dokter/lab/{noReg}', [RajalDokterController::class, 'labDokter'])->name('rj.dokterLab');


        // Kondisi Pulang Rujuk Internal
        Route::get('rajal/dokter/kondisi_pulang/SKDP/{noReg}', [KondisiPulangController::class, 'SkdpRS'])->name('kondisiPulang.SkdpRS');
        Route::post('rajal/dokter/kondisi_pulang/SKDP/', [KondisiPulangController::class, 'SkdpAdd'])->name('kondisiPulang.SkdpAdd');
        Route::get('rajal/dokter/kondisi_pulang/EditSKDP/{noReg}', [KondisiPulangController::class, 'EditSkdpRS'])->name('kondisiPulang.EditSkdpRS');
        Route::put('rajal/dokter/kondisi_pulang/EditSKDP/{noReg}', [KondisiPulangController::class, 'SkdpEdit'])->name('kondisiPulang.UpdateSkdpRS');
        // Kondisi Pulang Rawat Inap
        Route::get('rajal/dokter/kondisi_pulang/rawatInap/{noReg}', [KondisiPulangController::class, 'rawatInap'])->name('kondisiPulang.rawatInap');
        Route::post('rajal/dokter/kondisi_pulang/rawatInap/', [KondisiPulangController::class, 'rawatInapAdd'])->name('kondisiPulang.rawatInapAdd');
        Route::get('rajal/dokter/kondisi_pulang/EditrawatInap/{noReg}', [KondisiPulangController::class, 'rawatInapEdit'])->name('kondisiPulang.rawatInapEdit');
        Route::put('rajal/dokter/kondisi_pulang/EditrawatInap/{noReg}', [KondisiPulangController::class, 'rawatInapUpdate'])->name('kondisiPulang.rawatInapUpdate');
        // Kondisi Pulang Rujuk Internal
        Route::get('rajal/dokter/kondisi_pulang/rujukInternal/{noReg}', [KondisiPulangController::class, 'rujukInternalRS'])->name('kondisiPulang.rujukInternalRS');
        Route::post('rajal/dokter/kondisi_pulang/rujukInternal/', [KondisiPulangController::class, 'rujukInternalAdd'])->name('kondisiPulang.rujukInternalAdd');
        Route::get('rajal/dokter/kondisi_pulang/EditrujukInternal/{noReg}', [KondisiPulangController::class, 'rujukInternalEdit'])->name('kondisiPulang.rujukInternalEdit');
        Route::put('rajal/dokter/kondisi_pulang/EditrujukInternal/{noReg}', [KondisiPulangController::class, 'rujukInternalUpdate'])->name('kondisiPulang.rujukInternalUpdate');
        // Kondisi Pulang Rujuk Luar
        Route::get('rajal/dokter/kondisi_pulang/rujukLuar/{noReg}', [KondisiPulangController::class, 'rujukLuarRS'])->name('kondisiPulang.rujukLuarRS');
        Route::post('rajal/dokter/kondisi_pulang/rujukLuar/', [KondisiPulangController::class, 'rujukLuarAdd'])->name('kondisiPulang.rujukLuarAdd');
        Route::get('rajal/dokter/kondisi_pulang/EditrujukLuar/{noReg}', [KondisiPulangController::class, 'rujukLuarEdit'])->name('kondisiPulang.rujukLuarEdit');
        Route::put('rajal/dokter/kondisi_pulang/EditrujukLuar/{noReg}', [KondisiPulangController::class, 'rujukLuarUpdate'])->name('kondisiPulang.rujukLuarUpdate');
        // Kondisi Pulang Faskes PRB
        Route::get('rajal/dokter/kondisi_pulang/faskesPRB/{noReg}', [KondisiPulangController::class, 'faskesPRB'])->name('kondisiPulang.faskesPRB');
        Route::post('rajal/dokter/kondisi_pulang/faskesPRB/', [KondisiPulangController::class, 'faskesPRBAdd'])->name('kondisiPulang.faskesPRBAdd');
        Route::get('rajal/dokter/kondisi_pulang/EditfaskesPRB/{noReg}', [KondisiPulangController::class, 'faskesPRBEdit'])->name('kondisiPulang.faskesPRBEdit');
        Route::put('rajal/dokter/kondisi_pulang/EditfaskesPRB/{noReg}', [KondisiPulangController::class, 'faskesPRBUpdate'])->name('kondisiPulang.faskesPRBUpdate');
    });

    // Rawat Inap berkas
    Route::prefix('ri')->group(function () {
        // cppt
        Route::get('cppt/', [CpptController::class, 'index'])->name('cppt.index');
        Route::get('cppt/cariProses', [CpptController::class, 'cari_process'])->name('cppt.cariProcess');
        Route::get('cppt/addCppt/{noReg}', [CpptController::class, 'create'])->name('cppt.addCppt');

        // Rawat Inap Berkas
        Route::get('detail/Berkas/{noReg}', [BerkasRanapController::class, 'index'])->name('rm.detail');
        Route::get('detail/cetakKeperawatanRanap/{noReg}', [BerkasRanapController::class, 'AssesmenAwalKeperawatanRanap'])->name('ri.cetakKeperawatanRanap');

        // Detail Rawat Inap
        Route::get('detail/berkasRencana/{noReg}', [DetailRanapController::class, 'rencanaKeperawatan'])->name('ri.detailRencana');
        Route::get('detail/berkasTindakan/{noReg}', [DetailRanapController::class, 'tindakanKeperawatan'])->name('ri.detailTindakan');
        Route::get('detail/berkasObat/{noReg}', [DetailRanapController::class, 'pemberianObat'])->name('ri.detailObat');
    });

    // // Ruang Operasi Kamar
    // Route::prefix('ok')->group(function () {
    //     // Penandaan Lokasi Operasi
    //     Route::get('/jadwalOperasi', [PenandaanOperasiController::class, 'index'])->name('penandaanOperasi.jadwal');
    //     Route::get('/penandaanOperasi/create', [PenandaanOperasiController::class, 'create'])->name('penandaanOperasi.create');
    //     // OK Ruangan
    //     Route::get('/ruangOperasi', [RuangOperasiController::class, 'index'])->name('ruangOperasi.index');
    //     Route::post('/ruangOperasi', [RuangOperasiController::class, 'store'])->name('ruangOperasi.store');
    //     Route::put('/ruangOperasi/update/{id}', [RuangOperasiController::class, 'update'])->name('ruangOperasi.update');
    //     Route::delete('/ruangOperasi/delete/{id}', [RuangOperasiController::class, 'destroy'])->name('ruangOperasi.destroy');

    //     // booking operasi
    //     Route::get('/bookingOperasi', [BookingOperasiController::class, 'index'])->name('bookingOperasi.index');
    // });

    //IGD
    Route::prefix('igd')->group(function () {

        // triase
        Route::get('triase/', [TriaseController::class, 'index'])->name('triase.index');
        Route::get('triase/add/{tanggal}', [TriaseController::class, 'create'])->name('triase.create');
        //Layanan IGD
        // ------------ EWS --------------- //
        Route::get('layananIGD/ewsDewasa', [EwsController::class, 'ewsDewasa'])->name('layanan.ewsDewasa');
        Route::get('layananIGD/ewsDewasa/add', [EwsController::class, 'addDewasa'])->name('layanan.ewsDewasa.add');
        Route::get('layananIGD/ewsAnak', [EwsController::class, 'ewsAnak'])->name('layanan.ewsAnak');
        Route::get('layananIGD/ewsAnak/add', [EwsController::class, 'addAnak'])->name('layanan.ewsAnak.add');
        Route::get('layananIGD/ewsHamil', [EwsController::class, 'ewsHamil'])->name('layanan.ewsHamil');
        Route::get('layananIGD/ewsHamil/add', [EwsController::class, 'addHamil'])->name('layanan.ewsHamil.add');
        // ------- Skrining TB ------- //
        Route::get('layananIGD/SkriningTB', [SkriningController::class, 'index'])->name('layanan.skriningIndex');
        Route::get('layananIGD/SkriningTB/add', [SkriningController::class, 'add'])->name('layanan.skriningAdd');
        // ------- Assesmen Keperawatan ------------ //
        Route::get('layananIGD/assesmenPerawat', [LayananAssesmenController::class, 'assesmenPerawat'])->name('layanan.assesmenPerawat');
        Route::get('layananIGD/assesmenPerawat/add', [LayananAssesmenController::class, 'assesmenPerawatAdd'])->name('layanan.assesmenPerawatAdd');
        // ------- Assesmen Kebidanan ------------ //
        Route::get('layananIGD/assesmenBidan', [LayananAssesmenController::class, 'assesmenBidan'])->name('layanan.assesmenBidan');
        Route::get('layananIGD/assesmenBidan/add', [LayananAssesmenController::class, 'assesmenBidanAdd'])->name('layanan.assesmenBidanAdd');
        // ------- Assesmen Neonatus ------------ //
        Route::get('layananIGD/assesmenNeonatus', [LayananAssesmenController::class, 'assesmenNeonatus'])->name('layanan.assesmenNeonatus');
        Route::get('layananIGD/assesmenNeonatus/add', [LayananAssesmenController::class, 'assesmenNeonatusAdd'])->name('layanan.assesmenNeonatusAdd');
        // ------- Catatan Keperawatan ------------ //
        Route::get('layananIGD/catatanKeperawatan', [LayananAssesmenController::class, 'catatanKeperawatan'])->name('layanan.catatanKeperawatan');
        Route::get('layananIGD/catatanKeperawatan/add', [LayananAssesmenController::class, 'catatanKeperawatanAdd'])->name('layanan.catatanKeperawatanAdd');
    });

    // Riwayat Rekam Medis
    Route::prefix('rm')->group(function () {
        // ------------------- Berkas By MR -------------------- //
        Route::get('riwayatRekamMedis/bymr/list', [RekamMedisByMrController::class, 'index'])->name('rm.bymr');
        Route::get('riwayatRekamMedis/bymr/detailBerkas/cppt/{noReg}', [RekamMedisByMrController::class, 'detail_cppt'])->name('rm.cppt');
        Route::get('riwayatRekamMedis/bymr/resumeRanap/{noReg}', [RekamMedisByMrController::class, 'resumeRanap'])->name('rm.ranap');
        Route::get('riwayatRekamMedis/bymr/resumeRajal/{noReg}', [RekamMedisByMrController::class, 'resumeRajal'])->name('rm.rajal');

        // ------------------- Berkas Harian ------------------- //
        Route::get('riwayatRekamMedis/harian/list', [RekamMedisHarianController::class, 'index'])->name('rm.harian');

        // ------------------- Berkas IGD ---------------------- //
        Route::get('riwayatRekamMedis/igd/list', [RekamMedisIgdController::class, 'index'])->name('rm.igd');

        // Report Rekam Medis IGD
        Route::get('riwayaRekamMedis/igd/berkasIGD/cetakRM/{noReg}', [Berkas_rm_controller::class, 'cetakRMIgd'])->name('rm.berkasIgd');
        Route::get('riwayaRekamMedis/igd/berkasIGD/cetakTriase/{noReg}', [Berkas_rm_controller::class, 'cetakTriase'])->name('rm.triase');
        Route::get('riwayaRekamMedis/igd/berkasIGD/cetakAsesmenMedis/{noReg}', [Berkas_rm_controller::class, 'cetakAsesmenMedisIgd'])->name('rm.asesmenMedisIgd');
        Route::get('riwayaRekamMedis/igd/berkasIGD/cetakAsesmenPerawat/{noReg}', [Berkas_rm_controller::class, 'cetakAsesmenPerawatIgd'])->name('rm.asesmenPerawatIgd');

        // Report Berkas IGD
        Route::get('riwayatRekamMedis/igd/berkasIGD/cetakResep/{nomr}/{noReg}', [RekamMedisIgdController::class, 'cetakResepIGD'])->name('rm.cetakResepIGD');
        Route::get('riwayatRekamMedis/igd/berkasIGD/cetakRad/{nomr}/{noReg}', [RekamMedisIgdController::class, 'cetakRadIGD'])->name('rm.cetakRadIGD');
        Route::get('riwayatRekamMedis/igd/berkasIGD/cetakLab/{nomr}/{noReg}', [RekamMedisIgdController::class, 'cetakLabIGD'])->name('rm.cetakLabIGD');
    });

    Route::prefix('claim')->group(function () {
        // ------------------- Berkas Resume ---------------------- //
        Route::get('riwayatClaim/resume/rajal', [ResumeController::class, 'resumeRajal'])->name('rm.resumeRajal');
        Route::get('riwayatClaim/resume/ranap', [ResumeController::class, 'resumeRanap'])->name('rm.resumeRanap');
    });

    // Riwayat Rekam Medis
    Route::prefix('koding')->group(function () {

        Route::get('kodingDiagnosa/rajal/list', [KodingRajalController::class, 'index'])->name('koding.index');
        Route::get('kodingDiagnosa/rajal/addDiagnosa/{noReg}/{tanggal}/{kode_dokter}', [KodingRajalController::class, 'create'])->name('koding.add');
        Route::get('kodingDiagnosa/rajal/editDiagnosa/{noReg}', [KodingRajalController::class, 'show'])->name('koding.showEdit');
        Route::post('kodingDiagnosa/rajal/addProsesDiagnosa/{noReg}', [KodingRajalController::class, 'store'])->name('koding.addproses');
        Route::put('kodingDiagnosa/rajal/updateProsesDiagnosa/{noReg}', [KodingRajalController::class, 'update'])->name('koding.updateproses');
    });

    // MANAGE USER
    Route::prefix('mu')->group(function () {
        // USERS
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::put('/user{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

        // ROLES
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::put('/roles{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete');

        // PERMISSION
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::put('/permission{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');

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

// icd 10
Route::get('icd10/search', [KodingRajalController::class, 'search'])->name('icd10.search');
// icd 10

Route::get('/server', function () {
    return view('pages/rekam_medis/bymr/index');
});
Route::get('/server2', function () {
    return view('pages/rekam_medis/bymr/index');
});

Route::get('/test-lab', function () {
    $praService = new AssesmenPraBedahService();
    $data = $praService->getLabByKodeReg('23-00136634');
    dd($data);
});






require __DIR__ . '/auth.php';
require __DIR__ . '/vclaim.php';
require __DIR__ . '/operasi.php';
require __DIR__ . '/test_get_data.php';
