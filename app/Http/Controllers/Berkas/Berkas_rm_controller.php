<?php

namespace App\Http\Controllers\Berkas;

use App\Models\Pasien;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Berkas_rm_controller extends Controller
{

    protected $view;
    protected $rekam_medis;
    protected $routeIndex;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
    }

    public function cetakResep($noReg, $kode_transaksi)
    {
        $data = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.rekam_medis.resep', ['data' => $data, 'biodata' => $biodata, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakSKDP($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
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
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
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
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
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

    public function cetakRujukan($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        // Data Rujukan
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->select(
                'a.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

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
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        // Data Rujukan Internal
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->select(
                'a.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

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
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
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
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
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
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Faskes-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.rekam_medis.faskes', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }
}
