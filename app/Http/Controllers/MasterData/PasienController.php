<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Services\SatuSehat\PatientService;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    protected $pasien;
    protected $patientSatuSehat;
    protected $prefix;
    protected $routeIndex;
    protected $viewPath;
    protected $endpoint;

    public function __construct(Pasien $pasien)
    {
        $this->patientSatuSehat = new PatientService();
        $this->pasien = $pasien;
        $this->endpoint = 'Patient';
        $this->viewPath = 'pages.md.pasien.';
        $this->prefix = 'Patient';
        $this->routeIndex = 'patient.index';
    }

    public function index(Request $request)
    {
        try {
            $no_mr = $request->input('no_mr');
            $no_bpjs = $request->input('no_bpjs');
            $nik = $request->input('nik');
            $nama = $request->input('nama');

            if (empty($no_bpjs)) {
                $no_bpjs = '';
            }

            $title = 'Pasien';
            $data = $this->pasien->getData($no_mr, $no_bpjs, $nik, $nama);

            return view($this->viewPath . 'index', compact('data', 'title'));
        } catch (\Exception $e) {
            // Tangani kesalahan
            $message = json_decode($e, true);
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($noMr)
    {
        // amibil data nik by pasien
        $request = $this->pasien->getData($noMr);
        $nik = $request[0]['nik'];

        // parameter buat kirem ke api
        $params = [
            'identifier' => $nik
        ];

        // search by nik ke api satu sehat
        $pasien = $this->patientSatuSehat->getRequest($this->endpoint, $params);

        return $pasien['entry'][0]['resource']['id'];
    }

    public function edit()
    {
    }

    public function update()
    {
    }
}
