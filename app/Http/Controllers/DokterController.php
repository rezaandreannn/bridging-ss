<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        return view('pages.dokter', [
            'title' => 'Dokter',
        ]);
    }
}
