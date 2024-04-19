<?php

namespace App\Http\Controllers\Vclaim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bpjs\Bridging\Vclaim\BridgeVclaim;
use Illuminate\Support\Facades\Date;

class TestController extends Controller
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }


    public function getDiagnosa()
    {
        $dateNow = date('Y-m-d');
        $endpoint = 'SEP/FingerPrint/List/Peserta/TglPelayanan/' . $dateNow;
        return $this->bridging->getRequest($endpoint);
    }
}
