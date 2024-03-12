<?php

namespace App\Http\Controllers\Case\Encounter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncounterCreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $noReg)
    {
        dd($noReg);
        // fetch detail by no reg
        // get nik & kode dokter
        // fetch pasien API by nik
        // fetch mapping encounter
        // get practitioner
        // get organization ID
        // get Location 
        // send APi
        // send DB
    }
}
