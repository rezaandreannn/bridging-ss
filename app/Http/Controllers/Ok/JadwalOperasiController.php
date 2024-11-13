<?php

namespace App\Http\Controllers\OK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\SimRs\PendaftaranService;
use Carbon\Carbon;

class JadwalOperasiController extends Controller
{
    protected $view;
    protected $bookingOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.';
        $this->bookingOperasiService = new BookingOperasiService();
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $today = Carbon::today();

        $title = 'Jadwal Operasi';
        $jadwals = $this->bookingOperasiService->byDate($today);


        return view($this->view . 'jadwal-operasi.index', compact('jadwals'))
            ->with([
                'title' => $title
            ]);
    }
}
