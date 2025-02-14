<?php

namespace App\Http\Controllers\RiwayatMedis;

use Illuminate\Http\Request;
use App\Models\Simrs\Pendaftaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Operasi\BookingOperasi;
use App\Services\Operasi\BookingOperasiService;

class BerkasOperasiController extends Controller
{

    protected $bookingOperasi;
    public function __construct()
    {
        $this->bookingOperasi = new BookingOperasiService();
    }

    public function index(Request $request)
    {
        $noMr = $request->input('no_mr');

        $datas = collect();

        if ($noMr) {
            $datas = DB::table('PKU.dbo.ok_booking_operasi as obo')
                ->join('DB_RSMM.dbo.PENDAFTARAN as p', 'p.No_Reg', '=', 'obo.kode_register')
                ->join('DB_RSMM.dbo.REGISTER_PASIEN as rp', 'rp.No_MR', '=', 'p.No_MR')
                ->join('DB_RSMM.dbo.DOKTER as d', 'd.Kode_Dokter', '=', 'obo.kode_dokter')
                ->select('rp.Nama_Pasien', 'rp.Tgl_Lahir', 'obo.tanggal', 'rp.Jenis_Kelamin', 'obo.kode_dokter', 'obo.kode_register', 'p.No_MR', 'd.Nama_Dokter')
                ->where('p.No_MR', $noMr)
                ->get();

            if ($datas->isEmpty()) {
                return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan.');
            }
        }

        return view('pages.riwayat-medis.berkas-operasi.index', compact('datas'));
    }
}
