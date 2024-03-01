<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Services\SatuSehat\ConfigSatuSehat;
use App\Services\SatuSehat\PatientService;
use Illuminate\Http\Request;
use App\Services\SatuSehatService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $param = '1807062203970004';
        $client = new PatientService();
        $data = $client->getRequest('Patient', [
            'identifier' => $param,
            'name' => 'Reza andrean',
            'birthdate' => '1997-03-22'
        ]);
        return  $data;


        $no_mr = $request->input('no_mr');
        $no_bpjs = $request->input('no_bpjs');
        $nik = $request->input('nik');
        $nama = $request->input('nama');

        // Check if any parameters are empty and assign empty strings if they are
        $no_mr = $no_mr ?? '';
        $no_bpjs = $no_bpjs ?? '';
        $nik = $nik ?? '';
        $nama = $nama ?? '';

        // Call the method from the model to get filtered data
        $filters = Pasien::getSelect($no_mr, $no_bpjs, $nik, $nama);

        // Pass data to the view
        return view('content.master-data.pasien.index', [
            'title' => "Master Patient Index (MPI)",
            'sub_title' => 'Show ' . count($filters) . ' Data',
            'filters' => $filters
        ]);
    }
}
