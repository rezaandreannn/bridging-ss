<?php

namespace App\Http\Controllers\Ok\Medis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Models\Operasi\MasterData\TemplateOperasi;
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

        $biodata = $this->bookingOperasiService->biodata($kodeReg);

        return view('pages.ok.list-pasien.detail', compact('title', 'biodata'))->with([
            'bookingByRegister' => $this->bookingOperasiService->findByRegister($kodeReg),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
            'templates' => TemplateOperasi::where('kode_dokter', auth()->user()->username)->get()
        ]);
    }
}
