<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasFisioterapi extends Model
{
    use HasFactory;

    public function getFisioterapiHistory($no_mr)
    {

        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')->select(
                'p.No_Reg',
                'd.Nama_Dokter',
                'p.Medis',
                'p.Kode_Dokter',
                'p.No_MR',
                'p.Tanggal',
                'rp.Nama_Pasien'
                )
            ->where('p.No_MR', $no_mr)
            ->whereIn('p.Kode_Dokter', array('151', '028'))
            ->get();
            return $data;
        }
        
        public function getAsesmenDokter($no_reg)
        {
            
            $data = DB::connection('pku')
            ->table('fis_asesmen_dokter as ad')
            ->select(
                'ad.*',
                'diag_fungsi.nama_diagnosis_fungsi'
                
                )
                ->leftJoin('fis_master_diagnosis_fungsi as diag_fungsi', 'ad.diagnosa_klinis', '=', 'diag_fungsi.id')
                ->where('no_registrasi', $no_reg)
                ->first();
                return $data;
            }
            
            public function getLembarUjiFungsi($no_reg)
            {
                
                $data = DB::connection('pku')
                ->table('fis_lembar_uji_fungsi as lem_uji')
                ->select(
                    'lem_uji.*',
                    'diag_fungsi.nama_diagnosis_fungsi'
                    
                    )
                ->Join('fis_master_diagnosis_fungsi as diag_fungsi', 'lem_uji.diagnosis_fungsional', '=', 'diag_fungsi.id')
                ->where('lem_uji.no_registrasi', $no_reg)
                ->first();
                return $data;
            }
            
            public function getTerapiDokter($no_reg)
            {
                
                $data = DB::connection('pku')
                ->table('fis_tr_jenis as terapi')
                ->Join('TAC_COM_FISIOTERAPI_MASTER as tcf', 'terapi.id_jenis_fisioterapi', '=', 'tcf.ID_JENIS_FISIO')
                ->where('terapi.no_registrasi', $no_reg)
                ->get();
                return $data;
            }
            
            public function getLembarSpkfr($no_reg)
            {
                
                $data = DB::connection('pku')
            ->table('fis_lembar_spkfr as spkfr')
            ->select(
                'spkfr.*',
                'diag_fungsi.nama_diagnosis_fungsi',
                'diag_medis.nama_diagnosis_medis'
            )
            ->Join('fis_master_diagnosis_fungsi as diag_fungsi', 'spkfr.diagnosis_fungsi', '=', 'diag_fungsi.id')
            ->Join('fis_master_diagnosis_medis as diag_medis', 'spkfr.diagnosis_medis', '=', 'diag_medis.id')
            ->where('spkfr.no_registrasi', $no_reg)
            ->first();
        return $data;
    }
}
