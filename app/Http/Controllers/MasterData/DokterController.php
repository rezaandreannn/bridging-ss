<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $title = 'Dokter';
        return view('pages.md.dokter.index', compact('title'));
    }
}
