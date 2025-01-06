<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operasi\OperatorAsistenDetail;
use App\Models\Operasi\Operasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_laporan_operasi';

    protected $with = ['detailAsisten','tableOperasi','penandaanOperasi'];

    // Mass Assignment

    protected $fillable = [
        'kode_register',
        'tanggal',
        'diagnosa_pre_op',
        'diagnosa_post_op',
        'jaringan_dieksekusi',
        'mulai_operasi',
        'selesai_operasi',
        'lama_operasi',
        'permintaan_pa',
        'laporan_operasi',
        'macam_operasi',
        'pendarahan',
        'created_by',
        'updated_by'
    ];

    public function detailAsisten()
    {
        return $this->belongsTo(OperatorAsistenDetail::class, 'kode_register', 'kode_register');
    }

    public function tableOperasi()
    {
        return $this->belongsTo(Operasi::class, 'kode_register', 'kode_register');
    }

    public function penandaanOperasi()
    {
        return $this->belongsTo(penandaanOperasi::class, 'kode_register', 'kode_register');
    }
}
