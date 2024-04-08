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
        $this->view = 'pages.rekam_medis.';
        $this->routeIndex = 'rj.index';
    }
    public function cetakResep($noReg)
    {
        // Fetch data using the model
        // $data = $this->rekam_medis->cetakResep($noReg);
        $date = date('dMY');

        $filename = 'resep-' . $date . '-' . '123456';

        $pdf = PDF::loadview('pages.rekam_medis.resep');
        return $pdf->download($filename . '.pdf');
    }
}
