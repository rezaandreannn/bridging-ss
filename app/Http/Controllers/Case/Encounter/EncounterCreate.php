<?php

namespace App\Http\Controllers\Case\Encounter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncounterCreate extends Controller
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
    }
}
