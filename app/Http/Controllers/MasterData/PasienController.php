<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $title = 'Pasien';
        return view('pages.md.pasien.index', compact('title'));
    }
}
