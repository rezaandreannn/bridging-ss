<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index(Request $request)
    {
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
