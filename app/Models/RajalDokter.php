<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RajalDokter extends Model
{
    public function getPasienByDokter($kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = now();

        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->leftJoin('PENDAFTARAN as c', 'a.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'c.NO_REG', '=', 's.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'c.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'a.NOMOR',
                'a.NO_MR',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'c.NO_REG',
                's.FS_STATUS',
                'm.mdb',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'd.NAMA_DOKTER'
            )
            ->whereDate('a.TANGGAL', $date)
            ->whereDate('c.TANGGAL', $date)
            ->where('c.Kode_Dokter', $kode_dokter)
            ->orderBy('a.NOMOR', 'ASC')
            ->get()
            ->toArray();

        return $data;
    }

    public function getPasienByDokterMata($kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = now();

        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->leftJoin('PENDAFTARAN as c', 'a.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'c.NO_REG', '=', 's.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'c.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.poli_mata_asesmen as mata', 'c.NO_REG', '=', 'mata.NO_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'a.NOMOR',
                'a.NO_MR',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'c.NO_REG',
                's.FS_STATUS',
                'm.mdb',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'mata.CREATE_BY',
                'd.KODE_DOKTER',
                'd.NAMA_DOKTER'
            )
            ->whereDate('a.TANGGAL', $date)
            ->whereDate('c.TANGGAL', $date)
            ->where('c.Kode_Dokter', $kode_dokter)
            ->orderBy('a.NOMOR', 'ASC')
            ->get()
            ->toArray();

        return $data;
    }

    public function getPasienBySuratPoli($kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = date('Y-m-d');

        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->leftJoin('PENDAFTARAN as c', 'a.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'c.NO_REG', '=', 's.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'c.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'a.NOMOR',
                'a.NO_MR',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'c.NO_REG',
                's.FS_STATUS',
                'm.mdb',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'd.KODE_DOKTER',
                'd.NAMA_DOKTER',
                'c.KODE_MASUK'
            )
            ->where('a.TANGGAL', $date)
            ->where('c.TANGGAL', $date)
            ->where(function ($query) use ($kode_dokter) {
                $query->orWhere('c.Kode_Dokter', $kode_dokter)
                    ->orWhere('c.Kode_Dokter', '100');
            })
            ->orderBy('a.NOMOR', 'ASC')
            ->get()
            ->toArray();

        return $data;
    }

    public function getPasienBySurat($kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = now();

        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->leftJoin('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'p.NO_REG', '=', 's.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'p.NO_REG',
                's.FS_STATUS',
                'm.mdb',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'd.KODE_DOKTER',
                'd.NAMA_DOKTER',
            )
            ->whereDate('p.TANGGAL', $date)
            ->where('p.Kode_Dokter', '100')
            ->where('p.KODE_MASUK', 1)
            ->get()
            ->toArray();

        return $data;
    }

    public function getPasienByDokterMataRujukInternal($kode_dokter, $tanggal)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table($dbpku . '.dbo.TAC_RJ_RUJUKAN as m')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'm.FS_KD_REG', '=', 's.FS_KD_REG')
            ->leftJoin('PENDAFTARAN as c', 'm.FS_KD_REG', '=', 'c.NO_REG')
            ->leftJoin('REGISTER_PASIEN as rp', 'c.No_MR', '=', 'rp.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_ASES_PER2 as tap', 'c.NO_REG', '=', 'tap.FS_KD_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'm.FS_KD_REG',
                DB::raw('CAST(tap.FS_ANAMNESA AS VARCHAR(MAX)) as FS_ANAMNESA'),
                'c.NO_REG',
                'c.TANGGAL',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'd.NAMA_DOKTER',
                's.FS_STATUS'
            )
            ->distinct()
            ->where('m.FS_TUJUAN_RUJUKAN', $kode_dokter)
            ->where('c.TANGGAL', $tanggal)
            ->get();

        return $data;
    }

    public function getHistoryPasien($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('DOKTER as d', 'a.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->leftJoin('M_SPESIALIS as c', 'd.SPESIALIS', '=', 'c.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.KODE_RUANG',
                'a.STATUS',
                'a.NO_REG',
                'a.NO_MR',
                'a.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.TGL_LAHIR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.JENIS_KELAMIN',
                'd.NAMA_DOKTER',
                'c.SPESIALIS',
                'm.FS_KD_MEDIS',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.NO_MR', $noMR)
            ->orderBy('a.TANGGAL', 'DESC')
            ->take(15)
            ->get();

        return $data;
    }

    public function getHistoryPasienFisio($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('DOKTER as d', 'a.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->leftJoin('M_SPESIALIS as c', 'd.SPESIALIS', '=', 'c.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.KODE_RUANG',
                'a.STATUS',
                'a.NO_REG',
                'a.NO_MR',
                'a.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.TGL_LAHIR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.JENIS_KELAMIN',
                'd.NAMA_DOKTER',
                'c.SPESIALIS',
                'm.FS_KD_MEDIS',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.NO_MR', $noMR)
            ->orderBy('a.TANGGAL', 'DESC')
            ->take(15)
            ->get();

        return $data;
    }

    public function getHistoryPemeriksaanPasien($noMR = "", $tanggal, $kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('DOKTER as d', 'a.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->leftJoin('M_SPESIALIS as c', 'd.SPESIALIS', '=', 'c.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.KODE_RUANG',
                'a.STATUS',
                'a.NO_REG',
                'a.NO_MR',
                'a.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.TGL_LAHIR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.JENIS_KELAMIN',
                'd.NAMA_DOKTER',
                'c.SPESIALIS',
                'm.FS_KD_MEDIS',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->orWhere('a.NO_MR', $noMR)
            // ->orWhere('a.KODE_DOKTER', $kode_dokter)
            // ->orWhere('a.TANGGAL', $tanggal)
            ->orderBy('a.TANGGAL', 'DESC')
            ->get();

        return $data;
    }

    public function getHistoryPasienPoliMata($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('DOKTER as d', 'a.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->leftJoin('M_SPESIALIS as c', 'd.SPESIALIS', '=', 'c.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.KODE_RUANG',
                'a.STATUS',
                'a.NO_REG',
                'a.NO_MR',
                'a.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.TGL_LAHIR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.JENIS_KELAMIN',
                'd.NAMA_DOKTER',
                'c.SPESIALIS',
                'm.FS_KD_MEDIS',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.NO_MR', $noMR)
            ->orderBy('a.TANGGAL', 'DESC')
            ->take(15)
            ->get();

        return $data;
    }

    public function getDataLab($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as a')
            ->select(
                'a.No_Reg',
            )
            ->where('a.No_Reg', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataResep($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_RESEP as a')
            ->select(
                'a.No_Reg',
            )
            ->where('a.No_Reg', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function resep($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_DETAIL_RESEP as a')
            ->join('TR_MASTER_RESEP as b', 'a.NO_RESEP', '=', 'b.NO_RESEP')
            ->join('OBAT as c', 'a.KODE_OBAT', '=', 'c.KODE_OBAT')
            ->join('SATUAN_OBAT as d', 'c.ID_SATUAN', '=', 'd.ID_SATUAN')
            ->where('b.NO_REG', $noReg)
            ->orderBy('c.Nama_Obat', 'ASC')
            ->get();
        return $data;
    }

    public function lab($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as a')
            ->join('TR_DETAIL_LAB as b', 'b.Id_Lab', '=', 'a.Id_Lab')
            ->join('REGISTER_PASIEN as c', 'a.No_MR', '=', 'c.No_MR')
            ->join('LAB_HASIL as e', 'b.Kode_Hasil', '=', 'e.Kode_Hasil')
            ->join('DOKTER as f', 'a.Pengirim', '=', 'f.Kode_Dokter')
            ->select(
                'a.*',
                'b.Kode_Hasil',
                'b.Hasil',
                'b.Status',
                'c.Nama_Pasien',
                'e.Nilai_Normal',
                'e.Pemeriksaan',
                'f.Nama_Dokter',
            )
            ->where('a.No_Reg', $noReg)
            ->get();
        return $data;
    }

    public function radiologi($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_BIAYARINCI as a')
            ->leftJoin('TR_DETAIL_CATATANDOKTER as b', 'b.ID_BIAYA', '=', 'a.ID_BIAYA')
            ->join('M_RINCI_HEADER as c', 'c.NO_RINCI', '=', 'a.NO_RINCI')
            ->select(
                'a.*',
                'c.KET_TINDAKAN',
                'b.Ket'
            )
            ->where('a.NO_REG', $noReg)
            ->where('a.NO_RINCI', 'like', 'B%')
            ->get();

        return $data;
    }

    public function konsulan($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->leftJoin($dbpku . '.dbo.DOKTER as b', 'a.FS_TUJUAN_RUJUKAN', '=', 'b.KODE_DOKTER')
            ->select(
                'a.FS_TUJUAN_RUJUKAN',
                'b.NAMA_DOKTER',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->get();
        return $data;
    }

    public function getMasterLab()
    {
        $data = DB::connection('db_rsmm')
            ->table('LAB_JENISPERIKSA as a')
            ->select(
                'a.id',
                'a.No_Kelompok',
                'a.No_Jenis',
                'a.Jenis'
            )
            ->orderBy('jenis')
            ->get();
        return $data;
    }

    public function getLabByKodeReg($noReg)
    {
        $data = DB::connection('pku')
            ->table('ta_trs_kartu_periksa4 as a')
            ->select(
                'a.*'
            )
            ->where('fs_kd_reg2', $noReg)
            ->get();
        return $data;
    }
    public function getRadByKodeReg($noReg)
    {
        $data = DB::connection('pku')
            ->table('ta_trs_kartu_periksa5 as a')
            ->select(
                'a.*'
            )
            ->where('fs_kd_reg2', $noReg)
            ->get();
        return $data;
    }

    public function getCekRad($noReg)
    {
        $data = DB::connection('pku')
            ->table('ta_trs_kartu_periksa5 as a')
            ->select(
                'a.*'
            )
            ->where('fs_kd_reg2', $noReg)
            ->first();
        return $data;
    }


    public function getMasterRadiologi()
    {

        $data = DB::connection('db_rsmm')
            ->table('M_RINCI_HEADER as a')
            ->select(
                'a.No_Rinci',
                'a.Ket_Tindakan'
            )
            ->where('No_Rinci', 'like', 'B%')
            ->get();
        return $data;
    }

    public function getMasterObat()
    {

        $data = DB::connection('db_rsmm')
            ->table('Obat as a')
            ->select(
                'a.Nama_Obat',

            )
            ->get();
        return $data;
    }

    public function getAsesmenPerawat($noReg)
    {

        $data = DB::connection('pku')
            ->table('TAC_ASES_PER2 as a')
            ->select(
                'a.fs_skdp_faskes',
                'a.fs_anamnesa',

            )
            ->where('FS_KD_REG', $noReg)
            ->first();
        return $data;
    }


    public function getHasilLab($noReg)
    {

        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as a')
            ->join('TR_DETAIL_LAB as b', 'b.Id_Lab', '=', 'a.Id_Lab')
            ->join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->join('LAB_HASIL as lh', 'lh.Kode_Hasil', '=', 'b.Kode_Hasil')
            ->join('DOKTER as d', 'd.Kode_Dokter', '=', 'a.pengirim')
            ->select(
                'a.*',
                'b.kode_hasil',
                'b.hasil',
                'b.status',
                'rp.nama_pasien',
                'lh.nilai_normal',
                'lh.pemeriksaan',
                'd.nama_dokter',

            )
            ->where('a.No_Reg', $noReg)
            ->orderBy('a.no_kelompok')
            ->orderBy('a.no_Jenis')
            ->orderBy('a.tanggal')
            ->get();
        return $data;
    }

    public function getVitalSign($noReg)
    {

        $data = DB::connection('pku')
            ->table('TAC_RJ_VITAL_SIGN as a')

            ->select(
                'a.*'

            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }
    public function getSkalaNyeri($noReg)
    {

        $data = DB::connection('pku')
            ->table('TAC_RJ_NYERI as a')

            ->select(
                'a.*'

            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function getIcd10Dokter()
    {

        $data = DB::connection('bridging_ss')
            ->table('satusehat_icd10')
            ->where('icd10_code', 'like', 'Z%')
            ->orWhere('icd10_code', 'like', 'A%')
            ->get();
        return $data;
    }

    public function getIcd10()
    {

        $data = DB::connection('bridging_ss')
            ->table('satusehat_icd10')
            ->select(
                'id',
                'icd10_code',
                'icd10_en',
                'icd10_id'
                )
            ->get();

        return $this->mapData($data);

    }

    private function mapData($icd10)
    {
        return collect($icd10->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'icd10_code' => $item->icd10_code,
                'icd10_en' => $item->icd10_en,
                'icd10_id' => $item->icd10_id,
            ];
        }));
    }

}
