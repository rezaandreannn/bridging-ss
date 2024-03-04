<?php

namespace App\Http\Controllers\Kunjungan;

use App\Models\Antrean;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AntreanController extends Controller
{
    protected $antrean;

    public function __construct(Antrean $antrean)
    {
        $this->antrean = $antrean;
    }

    public function index(Request $request)
    {
        try {
            $title = 'Antrean';
            $data = $this->antrean->getData();
            $dokters = $this->antrean->byKodeDokter();
            return view('pages.kunjungan.antrean.index', ['data' => $data, 'dokters' => $dokters]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }
}
