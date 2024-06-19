<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SatuSehat\PatientService;

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

    // public function show($no_mr)
    // {
    //     // $request = $this->pasien->getData($no_mr);
    //     $pasien =  DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('No_MR', $no_mr)->first();

    //     $nik = $request->nik ?? null;
    //     $params = [
    //      'identifier' => $nik
    //     ];

    //     $pasiens = $this->pasien->getByNoMR($no_mr);

    //     dd($pasiens);
    //     die;
    //     return view($this->viewPath . 'detail', compact('pasien', 'pasiens'));
    // }

    public function show(Request $request, $no_mr)
    {
        // $pasiens =  DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('No_MR', $no_mr)->first();
        $pasiens = $this->pasien->getByNoMR($no_mr);
        return view($this->viewPath . 'detail', compact('pasiens'));
    }

    public function edit()
    {
    }

    public function update()
    {
    }
}
