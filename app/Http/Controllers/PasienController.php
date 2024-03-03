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
    public function index()
    {
        // $param = '1807062203970004';
        // $client = new PatientService();
        // $data = $client->getRequest('Patient', [
        //     'identifier' => $param,
        //     'name' => 'Reza andrean',
        //     'birthdate' => '1997-03-22'
        // ]);
        // return  $data;

        return view('pages.pasien', ['type_menu' => 'master-data']);
    }
}
