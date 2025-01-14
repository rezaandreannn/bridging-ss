<?php

namespace App\Http\Controllers\Ok\Medis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Simrs\Dokter;
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

        if (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;

            $DoctorName = Dokter::where('Kode_Dokter', $sessionKodeDokter)
                ->pluck('Nama_Dokter')
                ->first();

            // Ambil pasien dokter
            $patients = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
        } else {
            abort(403);
        }

        return view('pages.ok.list-pasien.index', compact('title', 'patients', 'date', 'DoctorName'));
    }
}
