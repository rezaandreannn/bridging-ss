<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TandaTangan extends Model
{
    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    protected $httpClient;
    protected $guarded = [];
    protected $simrsUrlApi;

    public function tandaTanganGet()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/ttd/petugas');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function tandaTanganGetById($id)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/ttd/petugas/' . $id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
