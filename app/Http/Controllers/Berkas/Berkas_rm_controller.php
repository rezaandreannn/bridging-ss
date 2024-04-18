<?php

namespace App\Http\Controllers\Berkas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekam_medis;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $date = date('dMY');

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.rekam_medis.resep', ['data' => $data]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }
}
