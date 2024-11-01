<?php

namespace App\Http\Controllers\Berkas;

use App\Models\Igd;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\RawatInap;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\NumberToWords;

class Berkas_rm_controller extends Controller
{

    protected $view;
    protected $rajaldokter;
    protected $rawatinap;
    protected $rekam_medis;
    protected $igd;
    protected $rajal;
    protected $routeIndex;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->rajaldokter = new RajalDokter;
        $this->rawatinap = new RawatInap;
        $this->igd = new Igd;
        $this->rajal = new Rajal;
    }

    public function cetakResep($noReg, $kode_transaksi)
    {
        $data = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        // dd($data);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $antrian = $this->rekam_medis->getAntrianObat($kode_transaksi);
        // dd($antrian);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.rekam_medis.resep', ['data' => $data, 'biodata' => $biodata, 'tanggal' => $tanggal, 'antrian' => $antrian]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakResepAlkes($noReg)
    {
        $data = $this->rekam_medis->cetakAlkes($noReg);
        // dd($data);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        // dd($antrian);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'resep-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.alat_kesehatan.resepAlkes', ['data' => $data, 'biodata' => $biodata, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakKwitansiAlkes($noReg)
    {

        // dd('ok');
        $data = $this->rekam_medis->cetakAlkes($noReg);

        $terbilang = NumberToWords::terbilang($data->biaya);
        // dd($data);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        // dd($antrian);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'resep-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.alat_kesehatan.kwitansi', ['data' => $data, 'biodata' => $biodata, 'tanggal' => $tanggal, 'biaya' => $terbilang]);
        // Set paper size to A5
        $pdf->setPaper('A5', 'landscape');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakSKDP($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // Data SKDP
        $data = DB::connection('pku')
            ->table('TAC_RJ_SKDP as a')
            ->leftJoin('TAC_COM_PARAMETER_SKDP_ALASAN as b', 'a.FS_SKDP_1', '=', 'b.FS_KD_TRS')
            ->leftJoin('TAC_COM_PARAMETER_SKDP_RENCANA as c', 'a.FS_SKDP_2', '=', 'c.FS_KD_TRS')
            ->select(
                'a.*',
                'b.FS_NM_SKDP_ALASAN',
                'c.FS_NM_SKDP_RENCANA',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // $data = $this->rekam_medis->cetakSKDP($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'SKDP-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.skdp', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRAD($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // Data Radiologi
        $dbRsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TA_TRS_KARTU_PERIKSA5 as a')
            ->leftJoin($dbRsmm . '.dbo.M_RINCI_HEADER as b', 'a.FS_KD_TARIF', '=', 'b.NO_RINCI')
            ->select(
                'a.fs_bagian',
                'b.KET_TINDAKAN',
            )
            ->where('a.FS_KD_REG2', $noReg)
            ->first();


        // $data = $this->rekam_medis->cetakRAD($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');

        $filename = 'Radiologi-' . $date . '-' . $noReg;
        $tanggal = Carbon::now();
        $pdf = PDF::loadview('pages.rekam_medis.radiologi', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakLAB($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // Data Laboratorium
        $dbRsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TA_TRS_KARTU_PERIKSA4 as a')
            ->leftJoin($dbRsmm . '.dbo.LAB_JENISPERIKSA as b', 'a.FS_KD_TARIF', '=', 'b.no_jenis')
            ->select(
                'b.JENIS',
            )
            ->where('a.FS_KD_REG2', $noReg)
            ->first();

        // $data = $this->rekam_medis->cetakLAB($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'LAB-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.laboratorium', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRujukan($noReg, $kode_transaksi, $id_surat)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // dd($resep);

        // Data Rujukan
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->select(
                'a.*',

            )
            ->where('a.FS_KD_REG', $noReg)
            ->where('a.FS_KD_TRS', $id_surat)
            ->first();

        // dd($data);

        // $data = $this->rekam_medis->cetakRujukan($noReg);

        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Rujukan-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.rujukanRS', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRujukanInternal($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // dd($resep);
        // Data Rujukan Internal
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'a.FS_TUJUAN_RUJUKAN', '=', 'c.KODE_DOKTER')
            ->select(
                'a.*',
                'c.NAMA_DOKTER'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // dd($data);

        // $data = $this->rekam_medis->cetakRujukan($noReg);

        // Data PRB
        $noPRB = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->select(
                'a.FS_KD_TRS',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // $noPRB = $this->rekam_medis->getNoPRB($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Rujukan-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.rekam_medis.rujukanInternal', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal, 'noPRB' => $noPRB]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakPRB($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // Data PRB
        $data = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->select(
                'a.FS_KD_TRS',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();


        // $data = $this->rekam_medis->getNoPRB($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'PRB-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.prb', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakFaskes($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        // Data Faskes
        $data = DB::connection('pku')
            ->table('TAC_RJ_PRB as a')
            ->select(
                'a.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // $data = $this->rekam_medis->cetakPRB_Faskes($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Faskes-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.faskes', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakHasilEcho($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep2($noReg, $kode_transaksi);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'HasilEcho-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.hasilEcho', ['biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRM($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);
        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $asesmenPerawat = $this->rekam_medis->cetakRmRajal($noReg);
        // dd($asesmenPerawat);

        $asesmenDokterRj = $this->rekam_medis->asesmenDokterRjBynoReg($noReg);
        if ($asesmenPerawat == null && $asesmenDokterRj == null) {
            return redirect()->back()->with('warning', 'data rekam medis belum di inputkan di EMR!');
        }
        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);
        // Cetak PDF
        // dd($asesmenDokterRj);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rj.dokter.cetak.rm', ['tanggal' => $tanggal, 'title' => $title, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'perawat' => $asesmenPerawat, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan, 'asesmenDokterRj' => $asesmenDokterRj]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRMIgd($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);
        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // ----- IGD ----- //
        $triase = $this->igd->getDataTriaseByNoReg($noReg);
        $perawatIGD = $this->igd->getDataPerawatByNoReg($noReg);
        $medis = $this->igd->getDataMedisByNoReg($noReg);
        // ----- Rajal ----- //
        $asesmenPerawat = $this->rajal->assesmenPerawatIGD($noReg);
        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);

        // Cetak PDF
        // dd($asesmenDokterRj);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.igd.cetakRM', ['tanggal' => $tanggal, 'title' => $title, 'triase' => $triase, 'perawatIGD' => $perawatIGD, 'medis' => $medis, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'assesmenPerawat' => $asesmenPerawat, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakAsesmenMedisIgd($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);
        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // ----- IGD ----- //

        $asesmenPerawat = $this->rajal->assesmenPerawatIGD($noReg);
        $medis = $this->igd->getDataMedisByNoReg($noReg);


        // Cetak PDF
        // dd($asesmenDokterRj);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.igd.cetakAsesmenMedisIgd', ['tanggal' => $tanggal, 'title' => $title, 'medis' => $medis, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'assesmenPerawat' => $asesmenPerawat]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakAsesmenPerawatIgd($noReg)
    {

        $biodata = $this->rekam_medis->getBiodata($noReg);
        // ----- IGD ----- //

        $perawatIGD = $this->igd->getDataPerawatByNoReg($noReg);
        $asesmenPerawat = $this->rajal->assesmenPerawatIGD($noReg);
        $medis = $this->igd->getDataMedisByNoReg($noReg);
        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);



        // Cetak PDF
        // dd($asesmenDokterRj);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.igd.cetakAsesmenKeperawatan', ['tanggal' => $tanggal, 'title' => $title, 'medis' => $medis, 'biodata' => $biodata, 'assesmenPerawat' => $asesmenPerawat, 'perawatIGD' => $perawatIGD, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakTriase($noReg)
    {

        $biodata = $this->rekam_medis->getBiodata($noReg);
        // ----- IGD ----- //
        $triase = $this->igd->getDataTriaseByNoReg($noReg);


        // Cetak PDF
        // dd($asesmenDokterRj);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.igd.cetakTriase', ['tanggal' => $tanggal, 'title' => $title, 'triase' => $triase, 'biodata' => $biodata]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }
}
