<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fisioterapi extends Model
{
    protected $httpClient;
    protected $guarded = [];
    protected $simrsUrlApi;

    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }
    use HasFactory;

    public function pasienCpptdanFisioterapi()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pendaftaran/listfisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}