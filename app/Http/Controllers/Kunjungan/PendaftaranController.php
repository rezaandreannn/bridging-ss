<?php

namespace App\Http\Controllers\Kunjungan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    protected $pendaftaran;

    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    public function index(Request $request)
    {
        try {
            $title = 'Antrean';
            $data = $this->pendaftaran->getData();
            $dokters = $this->pendaftaran->byKodeDokter();
            return view('pages.kunjungan.pendaftaran.index', ['data' => $data, 'dokters' => $dokters]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }
}
