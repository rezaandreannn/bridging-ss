<?php

namespace App\Http\Controllers\Kunjungan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AntreanController extends Controller
{
    public function index()
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $client = new Client([
            'headers'   => $headers
        ]);
        $request = $client->get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        return view('pages.kunjungan.antrean.index', compact('data'));


        // $client = new Client();
        // $url = "https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140";
        // $response = $client->request('GET', $url);
        // $content = $response->getBody()->getContents();
        // $data = json_decode($content, true);
        // return view('pages.rujukan', compact('data'));
    }
}
