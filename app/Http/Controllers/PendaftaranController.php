<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pages.pendaftaran', [
            'title' => 'Pendaftaran',
        ]);
    }
}
