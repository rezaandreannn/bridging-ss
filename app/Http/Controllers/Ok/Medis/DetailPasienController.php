<?php

namespace App\Http\Controllers\Ok\Medis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\LaporanOperasi;
use App\Models\Operasi\PenandaanOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Models\Operasi\MasterData\TemplateOperasi;
use App\Models\Operasi\Operasi;
use App\Models\Operasi\OperatorAsistenDetail;
use App\Models\Operasi\PascaBedah\PerencanaanPascaBedah;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahOther;
use App\Services\Operasi\LaporanOperasi\LaporanOperasiService;

class DetailPasienController extends Controller
{
    protected $bookingOperasiService;
    protected $laporanOperasiService;

    public function __construct()
    {
        $this->bookingOperasiService = new BookingOperasiService();
        $this->laporanOperasiService = new LaporanOperasiService();
    }

    public function index($kodeReg)
    {
        $title = 'Detail pasien';
        $patients = $this->bookingOperasiService->byRegister($kodeReg);
        $patient = $patients->first();
        // dd($patient);

        // Penandaan
        $penandaan = PenandaanOperasi::where('kode_register', $kodeReg)->first();

        // Assesmen
        $assesmen = AssesmenPraBedah::where('kode_register', $kodeReg)->first();
        $other = VerifikasiPraBedahOther::where('kode_register', $kodeReg)->first();

        // Laporan
        $detailOperasi = OperatorAsistenDetail::where('kode_register', $kodeReg)->first();
        $laporanOperasi = LaporanOperasi::where('kode_register', $kodeReg)->first();
        $anestesi = Operasi::where('kode_register', $kodeReg)->first();
        // dd($detailOperasi);

        // Pasca Bedah
        $pascaBedah = PerencanaanPascaBedah::where('kode_register', $kodeReg)->first();


        $biodata = $this->bookingOperasiService->biodata($kodeReg);

        return view('pages.ok.list-pasien.detail', compact('title', 'biodata', 'penandaan', 'assesmen', 'other', 'detailOperasi', 'laporanOperasi', 'anestesi', 'pascaBedah'))->with([
            'bookingByRegister' => $this->bookingOperasiService->findByRegister($kodeReg),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
            'perawatArray' => $this->laporanOperasiService->getPerawatArray($kodeReg),
            'ahliAnastesiArray' => $this->laporanOperasiService->getAhliAnastesiArray($kodeReg),
            'anastesiArray' => $this->laporanOperasiService->getAnastesiArray($kodeReg),
            'asistenArray' => $this->laporanOperasiService->getAsistenArray($kodeReg),
            'templates' => TemplateOperasi::where('kode_dokter', auth()->user()->username)->get()
        ]);
    }
}
