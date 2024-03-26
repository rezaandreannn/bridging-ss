<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encounter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $httpClient;
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

    public function byKodeDokter($kodeDokter = '')
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
