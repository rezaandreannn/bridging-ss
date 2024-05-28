<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
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
        $data = DB::connection('pku')
            ->table('TTD_PETUGAS_MASTER')
            ->get();
        return $data;
    }

    public function tandaTanganGetById($id)
    {
        $data = DB::connection('pku')
            ->table('TTD_PETUGAS_MASTER')
            ->where('ID_TTD', $id)
            ->get();
        return $data;
    }
}
