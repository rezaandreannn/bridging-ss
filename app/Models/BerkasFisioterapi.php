<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasFisioterapi extends Model
{
    use HasFactory;

    public function getFisioterapiHistorySpkfr($no_mr)
    {

        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')->select(
                'p.No_Reg',
                'd.Nama_Dokter',
                'd.Spesialis',
                'p.Medis',
                'p.Kode_Dokter',
                'p.No_MR',
                'p.Tanggal',
                'rp.Nama_Pasien'
                )
            ->where('p.No_MR', $no_mr)
            ->orderBy('p.Tanggal', 'desc')
            ->whereIn('p.Kode_Dokter', function ($query) {
                $query->select('d.Kode_Dokter')
                    ->from('DOKTER as d')
                    ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK'));
            })
        
            ->get();
            return $data;
        }

    public function getFisioterapAlkes($no_mr)
    {
        $pku = DB::connection('pku')->getDatabaseName();

        
        $data = DB::connection('db_rsmm')
        ->table('PENDAFTARAN as p')
        ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
        ->Join($pku . '.dbo.fis_order_alkes as alkes', 'p.No_Reg', '=', 'alkes.no_registrasi')
        ->leftJoin($pku . '.dbo.fis_verifikasi_alkes_by_bpjs as verif', 'p.No_Reg', '=', 'verif.no_registrasi')
        ->leftJoin($pku . '.dbo.fis_verifikasi_alkes_by_farmasi as farmasi', 'p.No_Reg', '=', 'farmasi.no_registrasi')
        ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')->select(
            'p.No_Reg',
            'd.Nama_Dokter',
            'd.Spesialis',
            'p.Medis',
            'p.Kode_Dokter',
            'p.No_MR',
            'p.Tanggal',
            'rp.Nama_Pasien',
            'alkes.jenis_alat',
            'alkes.lingkar_pinggang',
            'alkes.biaya',
            'verif.no_registrasi',
            'farmasi.no_registrasi as verif_farmasi'
            )
            ->where('p.No_MR', $no_mr)
            ->orderBy('p.Tanggal', 'desc')
            ->whereIn('p.Kode_Dokter', function ($query) {
                $query->select('d.Kode_Dokter')
                ->from('DOKTER as d')
                ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK'));
            })
        
            ->get();
            return $data;
        }

        public function getFisioterapiHistoryFisioterapi($no_mr)
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
                ->orderBy('p.Tanggal', 'desc')
                ->whereIn('p.Kode_Dokter', function ($query) {
                    $query->select('d.Kode_Dokter')
                    ->from('DOKTER as d')
                    ->whereIn('d.Spesialis', array('FISIOTERAPI'));
                })
                
                ->get();
                return $data;
            }
            
            public function getCpptFisioByNoreg($no_reg){
                
                $cekCppt = DB::connection('pku')
                ->table('TR_CPPT_FISIOTERAPI')
                ->select('ID_TRANSAKSI_FISIO')
                ->where('no_registrasi',$no_reg)
                ->first();
                
                return $cekCppt;
                
            }

    public function getFisioterapiByPelayananDokter($id_transaksi)
    {

        $excludedRegs = DB::connection('pku')
        ->table('TR_CPPT_FISIOTERAPI')
        ->where('ID_TRANSAKSI_FISIO',$id_transaksi)
        ->pluck('no_registrasi')
        ->toArray();
        
        
        
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
                ->orderBy('p.Tanggal', 'desc')
                ->whereIn('p.No_Reg', $excludedRegs)
                ->get();
                return $data;
            }
            
            public function getAsesmenDokter($no_reg)
            {
                
                $data = DB::connection('pku')
                ->table('fis_asesmen_dokter as ad')
                ->select(
                    'ad.*',
                    )
                    
                    ->where('no_registrasi', $no_reg)
                    ->first();
                    return $data;
                }
                
                public function cekAsesmenDokter($no_reg)
                {
                    
                    $data = DB::connection('pku')
                    ->table('fis_asesmen_dokter')
                    ->select('no_registrasi')
                    ->where('no_registrasi', $no_reg)
                    ->first();
                    
                    if ($data != null) {
                        return true;
                    } else {
                        return false;
                    }
                }
                
                public function getLembarUjiFungsi($no_reg)
                {
                    
                    $data = DB::connection('pku')
                    ->table('fis_lembar_uji_fungsi as lem_uji')
                    ->select(
                        'lem_uji.*',
                        
                        
                        )
                        
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
                    
                    )
                    
                    ->where('spkfr.no_registrasi', $no_reg)
                    ->first();
                    return $data;
                }
                
                public function getTtdPasienByMr($no_mr)
                {
                    
                    $data = DB::connection('pku')
                    ->table('TTD_PASIEN_MASTER')
                    ->select(
                        'IMAGE',
                        
                        )
                        
                        ->where('NO_MR_PASIEN', $no_mr)
                        ->first();
                        return $data;
                    }

                public function getTtdPasienByNoReg($no_reg)
                {
                    
                    $data = DB::connection('pku')
                    ->table('TTD_PASIEN_MASTER')
                    ->select(
                        'IMAGE',
                        
                        )
                        
                        ->where('NO_REGISTRASI', $no_reg)
                        ->first();
                        return $data;
                    }
                    
    public function transaksiFisioByMrLast($no_mr,$id_transaksi)
    {
                    
        $data = DB::connection('pku')
        ->table('TRANSAKSI_FISIOTERAPI')
        ->where('NO_MR_PASIEN', $no_mr)
        ->where('ID_TRANSAKSI',$id_transaksi)
        ->orderBy('ID_TRANSAKSI', 'DESC')
        ->get();
        return $data;
    }
    
    public function transaksiFisioByMr($no_mr)
    {
                    
        $data = DB::connection('pku')
        ->table('TRANSAKSI_FISIOTERAPI')
        ->where('NO_MR_PASIEN', $no_mr)
        ->orderBy('ID_TRANSAKSI', 'DESC')
        ->get();
        return $data;
    }
    
    public function getIdTransaksiFisio($no_reg)
    {
        // $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        // $response = $request->getBody()->getContents();
        // $data = json_decode($response, true);
        // return $data['data'];

        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->select('ID_TRANSAKSI_FISIO')
            ->where('no_registrasi', $no_reg)
         
            ->first();
            return $data;
        }
        
        public function cetakBerkasAlkes($no_reg)
        {
            
            $emr_rsumm = DB::connection('sqlsrv')->getDatabaseName();
            $data = DB::connection('pku')
            ->table('fis_order_alkes as alkes')
            ->leftJoin('fis_asesmen_dokter as dokter', 'dokter.no_registrasi', '=', 'alkes.no_registrasi')
            ->leftJoin('fis_verifikasi_alkes_by_bpjs as verif', 'verif.no_registrasi', '=', 'alkes.no_registrasi')
            ->leftJoin($emr_rsumm . '.dbo.users as user', 'user.id', '=', 'verif.updated_by')
            ->select(
                'alkes.*',
                'dokter.diagnosa_klinis',
                'verif.updated_by as verif_by',
                'verif.updated_at as verif_at',
                'user.name as nama_verifikator'
                )
                ->where('alkes.no_registrasi', $no_reg)
                
            ->first();
        return $data;
    }

    public function biodataPasienByMr($no_mr)
    {
        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
            ->leftJoin('DOKTER as c', 'b.KODE_DOKTER', '=', 'c.KODE_DOKTER')
            ->leftJoin('REKANAN as d', 'b.KODEREKANAN', '=', 'd.KODEREKANAN')
            ->select(
                'a.NAMA_PASIEN',
                'a.NO_MR',
                'a.HP1',
                'a.HP2',
                'a.ALAMAT',
                'a.KOTA',
                'a.PROVINSI',
                'a.JENIS_KELAMIN',
                'a.TGL_LAHIR',
                'a.FS_REAK_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU',
                'a.FS_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU2',
                'a.FS_HIGH_RISK',
                'b.No_MR',
                'b.No_Reg',
                'b.Tanggal',
                'c.NAMA_DOKTER',
                'c.SPESIALIS',
                'd.NAMAREKANAN',
            )
            ->where('a.NO_MR', $no_mr)
            ->whereIn('b.Kode_Dokter', function ($query) {
                $query->select('c.Kode_Dokter')
                    ->from('DOKTER as c')
                    ->whereIn('c.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'));
            })
            ->orderBy('b.No_Reg', 'DESC')
            ->limit('1')
            ->first();
        return $data;
    }

 public function cekCpptFisioterapi($no_reg)
    {
        // $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        // $response = $request->getBody()->getContents();
        // $data = json_decode($response, true);
        // return $data['data'];

        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->select('no_registrasi')
            ->where('no_registrasi', $no_reg)
         
            ->first();

            if($data!=null){
                return true;
            }else{
                return false;
            }
       
    }

 public function cekRincianAlkes($no_reg)
    {
        // $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        // $response = $request->getBody()->getContents();
        // $data = json_decode($response, true);
        // return $data['data'];

        $data = DB::connection('pku')
            ->table('fis_order_alkes')
            ->select(
                'lingkar_pinggang',
                'no_sep',
                'biaya'
                )
            ->where('no_registrasi', $no_reg)
         
            ->first();

            // dd($data);

        return $data;
       
    }
}
