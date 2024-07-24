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

    public function ttdPasienMaster()
    {
        $date = date('Y-m-d');
        $kode_dokter = array('028', '151');
        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->select(
                'a.NOMOR',

                'a.TANGGAL',
                'p.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.NO_MR',
                'p.NO_REG',
                'p.KODEREKANAN'

            )
            ->whereIn('p.Kode_Dokter', $kode_dokter)
            ->whereIn('a.Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->where('p.Status', '1')
            ->whereNotIn('a.No_MR', function ($query) use ($pku) {
                $query->select('tpm.NO_MR_PASIEN')
                      ->from($pku.'.dbo.TTD_PASIEN_MASTER as tpm');
            })
            ->orderBy('a.NOMOR', 'ASC')
            ->get()->toArray();
        return $data;
    }
    
}
