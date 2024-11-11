<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cppt extends Model
{
    use HasFactory;

        // //ini ditambah
        // function get_data_medis_by_rg($params) {
        //     $sql = "SELECT top 1 a.*,NAMALENGKAP
        //     FROM PKU.dbo.TAC_RI_MEDIS a
        //     LEFT JOIN DB_RSMM.dbo.TUSER b ON a.FS_KD_MEDIS=b.NAMAUSER
        //     WHERE FS_KD_REG = ? order by FS_KD_TRS desc";
        //     $query = $this->db->query($sql, $params);
        //     if ($query->num_rows() > 0) {
        //         $result = $query->row_array();
        //         $query->free_result();
        //         return $result;
        //     } else {
        //         return 0;
        //     }
        // }

        public function getAsesmenMedisRanapByNoreg($noReg)
        {
            $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
            $data = DB::connection('pku')
                ->table('TAC_RI_MEDIS as tri')
                ->leftJoin($db_rsmm . '.dbo.TUSER as u', 'tri.FS_KD_MEDIS', '=', 'u.NAMAUSER')
                ->select(
                    'tri.*',
                    'u.NAMAlENGKAP',
                )
                ->where('tri.FS_KD_REG', $noReg)
                ->orderBy('tri.FS_KD_TRS', 'desc')
                ->limit('1')
                ->first();
            return $data;
        }

        public function getCpptByNoreg($noReg)
        {
            $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
            $data = DB::connection('pku')
                ->table('TAC_RI_CPPT as trc')
                ->leftJoin($db_rsmm . '.dbo.TUSER as u', 'trc.mdb', '=', 'u.NAMAUSER')
                ->leftJoin('TAC_COM_USER as tcu', 'trc.mdb', '=', 'tcu.user_name')
                ->leftJoin('TAC_COM_ROLE_USER as role', 'tcu.user_id', '=', 'role.user_id')
                // ->leftJoin($db_rsmm . '.dbo.TUSER as tu', 'trc.FS_KD_MEDIS_VERIF', '=', 'tu.NAMAUSER')
                ->select(
                    'trc.*',
                    'u.NAMALENGKAP',
                    'trc.FS_KD_MEDIS_VERIF',
                    'role.role_id',
                    DB::raw('RIGHT(trc.mdd_date, 2) as tgl')
                )
                ->where('trc.FS_KD_REG', $noReg)
                ->where('trc.FD_TGL_VOID', '3000-01-01')
                ->orderBy('trc.mdd_date', 'DESC')
                ->orderBy('trc.mdd_time', 'DESC')
                ->get();
        
            return $data;
        }
}
