<?php

namespace App\Http\Controllers\Kunjungan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    protected $pendaftaran;
    protected $viewPath;

    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
        $this->viewPath = 'pages.kunjungan.pendaftaran.';
    }

    public function index(Request $request)
    {
        try {
            // Filter
            // Retrieve query parameters
            $kode_dokter = $request->input('kode_dokter');
            $tanggal = $request->input('tanggal');
            $status_rawat = $request->input('status_rawat');

            $title = 'Antrean';
            $data = $this->pendaftaran->getData($kode_dokter, $tanggal, $status_rawat);
            $dokters = $this->pendaftaran->byKodeDokter();
            return view('pages.kunjungan.pendaftaran.index', ['data' => $data, 'dokters' => $dokters]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    public function show($noReg)
    {
        try {
            // Menggunakan model Dokter untuk mencari data berdasarkan kode dokter
            $pendaftaran = $this->pendaftaran->getByKodeReg($noReg);
            return view($this->viewPath . 'detail', compact('pendaftaran'));
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the API request
            $errorMessage = "Error: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
