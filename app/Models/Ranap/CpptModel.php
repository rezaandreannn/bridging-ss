<?php

namespace App\Models\Ranap;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CpptModel extends Model
{
    use HasFactory;
    
    // function get_pasien_bangsal1($params) {
    //     $sql = "SELECT
    //      A.NO_REG,
    //      A.NO_MR,
    //      A.TGL_MULAI,        
    //      A.KODE_RUANG,
    //      B.NAMA_PASIEN,
    //      B.JENIS_KELAMIN,
    //      B.ALAMAT,
    //      D.KODE_BANGSAL,
    //      D.NAMA_BANGSAL,
    //      C.NAMA_RUANG,
    //      E.KODEREKANAN,
    //      F.NAMAREKANAN,
    //      B.ALAMAT
    //     FROM TR_KAMAR A, REGISTER_PASIEN B, M_RUANG C, M_BANGSAL D, PENDAFTARAN E, REKANAN F 
    //     WHERE A.NO_MR=B.NO_MR AND A.NO_REG=E.NO_REG AND E.KODEREKANAN=F.KODEREKANAN AND A.KODE_RUANG=C.KODE_RUANG AND C.KODE_BANGSAL=D.KODE_BANGSAL AND A.STATUS='1' AND E.STATUS='1'     ORDER BY D.KODE_BANGSAL,A.TGL_MULAI ";
    //     $query = $this->db->query($sql, $params);
    //     if ($query->num_rows() > 0) {
    //         $result = $query->result_array();
    //         $query->free_result();
    //         return $result;
    //     } else {
    //         return array();
    //     }
    // }

    public function pasienCppt(){
        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
        ->table('TR_KAMAR as trk')
        ->join('REGISTER_PASIEN as rp', 'trk.NO_MR', '=', 'rp.NO_MR')
        ->join('PENDAFTARAN as p', 'trk.NO_REG', '=', 'p.NO_REG')
        ->join('REKANAN as r', 'r.KODEREKANAN', '=', 'p.KODEREKANAN')
        ->join('M_RUANG as mr', 'mr.KODE_RUANG', '=', 'trk.KODE_RUANG')
        ->join('M_BANGSAL as mb', 'mb.KODE_BANGSAL', '=', 'mr.KODE_BANGSAL')
        ->select(
            'rp.Nama_Pasien',
            'rp.No_MR',
            'mb.NAMA_BANGSAL',
            'mr.NAMA_RUANG',
            'p.NO_REG',
        )
        ->where('trk.STATUS', '1')
        ->where('p.STATUS', '1')
        ->get();
        return $data;
    }  
}
