<?php

namespace App\Http\Controllers\Kunjungan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $title = 'Pendaftaran';
        return view('pages.kunjungan.pendaftaran.index', compact('title'));
    }
}
