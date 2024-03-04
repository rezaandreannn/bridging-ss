<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    protected $pasien;

    public function __construct(Pasien $pasien)
    {
        $this->pasien = $pasien;
    }

    public function index(Request $request)
    {
        try {
            // Filter
            // Retrieve query parameters
            $no_mr = $request->input('no_mr');
            $no_bpjs = $request->input('no_bpjs');
            $nik = $request->input('nik');
            $nama = $request->input('nama');

            if (empty($no_bpjs)) {
                $no_bpjs = '';
            }

            $title = 'Pasien';
            $data = $this->pasien->getData($no_mr, $no_bpjs, $nik, $nama);

            return view('pages.md.pasien.index', ['data' => $data]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }
}
