<?php

namespace App\Http\Controllers\Berkas;

use App\Models\Pasien;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class Berkas_rm_controller extends Controller
{

    protected $view;
    protected $rekam_medis;
    protected $routeIndex;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
    }

    public function cetakResep($noReg, $kode_transaksi)
    {
        $data = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $biodata = $this->rekam_medis->getBiodataResep($noReg);
        $date = date('dMY');

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.rekam_medis.resep', ['data' => $data, 'biodata' => $biodata]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakSKDP($noReg)
    {
        $data = $this->rekam_medis->cetakSKDP($noReg);
        $biodata = $this->rekam_medis->getBiodataResep($noReg);
        $date = date('dMY');

        $filename = 'resep-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.skdp', ['data' => $data, 'biodata' => $biodata]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }
}
