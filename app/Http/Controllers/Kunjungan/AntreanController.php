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

    public function getByKodeDokter(Request $request, $kodeDokter)
    {
        // Panggil metode byKodeDokter model Antrean untuk mengambil data
        $data = $this->antrean->byKodeDokter($kodeDokter);

        // Periksa apakah datanya kosong atau tidak
        if (empty($data)) {
            return response()->json(['message' => 'No data found'], 404);
        }

        // Kembalikan data yang diambil sebagai respons JSON
        return response()->json(['data' => $data], 200);
    }

    public function index()
    {

        // filtered
        $kode_dokter = $this->input->get('kode_dokter');
        $tanggal = $this->input->get('tanggal');
        try {
            // Mengambil daftar semua dokter
            $doctors = $this->byKodeDokter($kode_dokter);

            $data = $this->antrean->getData();
            return view('pages.kunjungan.antrean.index', ['data' => $data]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    // public function index()
    // {
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //     ];
    //     $client = new Client([
    //         'headers'   => $headers
    //     ]);
    //     $request = $client->get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140');
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response);
    //     return view('pages.kunjungan.antrean.index', compact('data'));
    // }
}
