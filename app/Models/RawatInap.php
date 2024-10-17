<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawatInap extends Model
{
    use HasFactory;

    // function get_px_by_dokter_by_rg2($params) {
    //     $sql = "SELECT A.NO_REG,A.NO_MR,A.TGL_MULAI,B.NAMA_PASIEN,A.KODE_RUANG, B.JENIS_KELAMIN,B.ALAMAT,D.KODE_BANGSAL,C.NAMA_RUANG,D.NAMA_BANGSAL,E.KODEREKANAN,F.NAMAREKANAN ,B.TGL_LAHIR,E.TANGGAL,E.JAM,datediff(year,B.TGL_LAHIR,GETDATE()) 'fn_umur'
    //     FROM TR_KAMAR A, REGISTER_PASIEN B, M_RUANG C, M_BANGSAL D, PENDAFTARAN E, REKANAN F 
    //     WHERE  A.NO_MR=B.NO_MR AND A.NO_REG=E.NO_REG AND E.KODEREKANAN=F.KODEREKANAN 
    //     AND A.KODE_RUANG=C.KODE_RUANG AND C.KODE_BANGSAL=D.KODE_BANGSAL AND A.NO_REG = ? 
    //     order by A.Tgl_Mulai desc";
    //     $query = $this->db->query($sql, $params);
    //     if ($query->num_rows() > 0) {
    //         $result = $query->row_array();
    //         $query->free_result();
    //         return $result;
    //     } else {
    //         return 0;
    //     }
    // }


    public function biodataPasienRanap($noReg)
    {

        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('TR_KAMAR as tk')
            // ->table('PENDAFTARAN as p')

            ->leftJoin('REGISTER_PASIEN as rp', 'tk.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('PENDAFTARAN as p', 'tk.NO_REG', '=', 'p.NO_REG')
            ->leftJoin('M_RUANG as mr', 'tk.KODE_RUANG', '=', 'mr.KODE_RUANG')
            ->leftJoin('M_BANGSAL as mb', 'mr.KODE_BANGSAL', '=', 'mb.KODE_BANGSAL')
            ->leftJoin('REKANAN as r', 'p.KODEREKANAN', '=', 'r.KODEREKANAN')

            // ->leftJoin('ANTRIAN as a', 'p.No_MR', '=', 'a.No_MR')
            // ->leftJoin('M_RUANG as mr', 'p.Kode_Ruang', '=', 'mr.Kode_Ruang')
            // ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as trm', 'p.No_Reg', '=', 'trm.FS_KD_REG')
            // ->leftJoin($pku . '.dbo.TAC_RJ_STATUS as trs', 'p.No_Reg', '=', 'trs.FS_KD_REG')

            ->select(
                // transaksi_kamar
                'tk.no_reg',
                'tk.no_mr',
                'tk.tgl_mulai',
                'tk.kode_ruang',
                // pendaftaran table
                'p.koderekanan',
                'p.tanggal',
                'p.jam',

                'rp.nama_pasien',
                'rp.jenis_kelamin',
                'rp.alamat',
                'rp.tgl_lahir',

                'mr.nama_ruang',
                'mb.nama_bangsal',

                'r.namarekanan',


            )
            ->where('tk.no_reg', $noReg)
            ->orderBy('tk.Tgl_Mulai', 'desc')
            ->first();
        return $data;
    }

    public function resumePasienRanapByNoreg($noReg)
    {
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME as resume')
            // ->table('PENDAFTARAN as p')
            ->leftJoin($db_rsmm . '.dbo.M_CARAMASUK as cm', 'resume.FS_KD_LAYANAN', '=', 'cm.KODE_MASUK')
            ->leftJoin($db_rsmm . '.dbo.M_CARAMASUK as cm2', 'resume.FS_KD_LAYANAN2', '=', 'cm2.KODE_MASUK')
            ->leftJoin($db_rsmm . '.dbo.TUSER as user', 'resume.FS_VERIF_DOKTER', '=', 'user.NAMAUSER')
            ->leftJoin($db_rsmm . '.dbo.PENDAFTARAN as p', 'resume.FS_KD_REG', '=', 'p.NO_REG')
            ->leftJoin($db_rsmm . '.dbo.M_RUANG as mr', 'mr.KODE_RUANG', '=', 'p.KODE_RUANG')
            ->leftJoin('TAC_COM_USER as tcu', 'resume.mdb_update', '=', 'tcu.user_id')
            ->leftJoin($db_rsmm . '.dbo.DOKTER as d', 'd.Kode_Dokter', '=', 'tcu.user_name')
            ->select(
                // transaksi_kamar
                'resume.*',
                'cm.ket_masuk',
                'cm2.ket_masuk as nama_layanan2',
                'p.tanggal',
                'p.tgl_keluar',
                'mr.nama_ruang',
                'd.nama_dokter',
            )
            ->where('resume.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }


    public function resumeDiagnosaSekunder($noReg)
    {
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME_DIAG_SEK as a')
            ->select(
                'a.*'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->orderBy('a.FS_KD_DIAG_SEK', 'asc')
            ->first();
        return $data;
    }

    public function resumeIdikasi($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME_INDIKASI_RAWAT as a')
            ->leftJoin('COM_PARAM_RM_40_INDIKASI_DIRAWAT as b', 'a.FS_KD_PARAM_INDIKASI_DIRAWAT', '=', 'b.FS_KD_PARAM_INDIKASI_DIRAWAT')
            ->select(
                'a.*',
                'b.*'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->get();
        return $data;
    }

    public function resumeDiet($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME_DIET as a')
            ->leftJoin('TAB_PX_PULANG_DIET as b', 'a.FS_KD_DIET', '=', 'b.FS_KD_DIET')
            ->select(
                'a.FS_KD_PX_PULANG_DIET',
                'a.FS_KD_DIET',
                'b.FS_NM_DIET'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->get();
        return $data;
    }

    public function resumeTindakan($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME_TIND as a')
            ->select(
                'a.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->orderBy('a.FS_KD_TIND', 'asc')
            ->first();
        return $data;
    }

    public function resumeTerapiPulang($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_TERAPI as a')
            ->select(
                'a.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->orderBy('a.FS_KD_TERAPI', 'asc')
            ->get();
        return $data;
    }
}
