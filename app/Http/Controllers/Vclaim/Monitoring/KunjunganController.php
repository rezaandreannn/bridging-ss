<?php

namespace App\Http\Controllers\Vclaim\Monitoring;

use App\Http\Controllers\Controller;
use App\Services\BPJS\Vclaim\Monitoring\KunjunganService;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    protected $kunjunganService;

    public function __construct()
    {
        $this->kunjunganService = new KunjunganService();
    }
    public function index()
    {

        $response = $this->kunjunganService->getKunjungan('2024-04-20', '2');
        if ($response['metaData']['code'] != 200) {
            $message = $response['metaData']['message'];
        } else {
            $kunjungans = $response['response']['sep'];
        }
        dd($kunjungans);

        return view('pages.bpjs.vclaim.monitoring.kunjungan-index');
    }
}
