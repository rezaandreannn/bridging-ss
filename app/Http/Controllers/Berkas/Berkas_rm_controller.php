<?php

namespace App\Http\Controllers\Berkas;

use App\Models\Pasien;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.rekam_medis.resep', ['data' => $data, 'biodata' => $biodata]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakSKDP($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $data = $this->rekam_medis->cetakSKDP($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'SKDP-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.skdp', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRAD($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $data = $this->rekam_medis->cetakRAD($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');

        $filename = 'Radiologi-' . $date . '-' . $noReg;
        $tanggal = Carbon::now();
        $pdf = PDF::loadview('pages.rekam_medis.radiologi', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakLAB($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $data = $this->rekam_medis->cetakLAB($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'LAB-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.laboratorium', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRujukan($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $data = $this->rekam_medis->cetakRujukan($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Rujukan-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.rujukanRS', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }
}
