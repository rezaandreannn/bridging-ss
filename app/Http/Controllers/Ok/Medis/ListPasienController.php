<?php

namespace App\Http\Controllers\Ok\Medis;

use Carbon\Carbon;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Helpers\Ok\PascaBedahHelper;
use App\Http\Controllers\Controller;
use App\Helpers\Ok\LaporanOperasiHelper;
use App\Services\Operasi\BookingOperasiService;

class ListPasienController extends Controller
{
    protected $bookingOperasiService;
    public function __construct()
    {
        $this->bookingOperasiService = new BookingOperasiService();
    }
    public function index()
    {
        $title = 'List pasien operasi';
        $date = date('Y-m-d');


        $patients = [];
        $DoctorName = null;
        $statusLaporanOperasi = null;
        $statusPascaBedah = null;

        if (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;

            $DoctorName = Dokter::where('Kode_Dokter', $sessionKodeDokter)
                ->pluck('Nama_Dokter')
                ->first();

            // Ambil pasien dokter
            $patients = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
            $statusLaporanOperasi = LaporanOperasiHelper::getStatusLaporanOperasi($patients);
            $statusPascaBedah = PascaBedahHelper::getStatusPascaBedah($patients);
            $statusPenandaan = BookingHelper::getStatusPenandaan($patients);
        } elseif (auth()->user()->hasRole('perawat ibs')) {
            $sessionIbs = auth()->user()->username ?? null;
            $patients = $this->bookingOperasiService->byDate($date, '',  '');
            // dd($patients);
        }

        return view('pages.ok.list-pasien.index', compact('patients', 'date', 'DoctorName'))
            ->with([
                'title' => $title,
                'statusLaporanOperasi' => $statusLaporanOperasi,
                'statusPascaBedah' => $statusPascaBedah,
                'statusPenandaan' => $statusPenandaan
            ]);
    }
}
