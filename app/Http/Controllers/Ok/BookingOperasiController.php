<?php

namespace App\Http\Controllers\OK;

use Exception;
use App\Models\RajalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SimRs\DokterService;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\RuanganOperasi;
use App\Services\SimRs\PendaftaranService;
use App\Services\Operasi\BookingOperasiService;
use App\Http\Requests\Operasi\StoreBookingRequest;
use App\Http\Requests\Operasi\UpdateBookingRequest;

class BookingOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    // menggunakan service
    protected $bookingOperasiService;
    protected $dokterService;
    protected $pasienService;

    public function __construct()
    {
        $this->view = 'pages.ok.';
        $this->prefix = 'Booking Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->dokterService = new DokterService();
        $this->pasienService = new PendaftaranService();
    }

    public function index(Request $request)
    {
        // variable declare
        $title = $this->prefix . ' ' . 'List';

        // get data from service
        $bookings = $this->bookingOperasiService->get();

        $booking = null;
        if (session('booking_id')) {
            $booking = $this->bookingOperasiService->findById(session('booking_id'));
        }
        // dd($booking);


        return view($this->view . 'booking-operasi.index', compact('bookings', 'booking'))->with([
            'title' => $title,
            'ruanganOperasi' => RuanganOperasi::all(),
            'dokters' => $this->dokterService->byBedahOperasi(),
            'pasien' => $this->pasienService->byStatusActive(),
        ]);
    }

    public function create()
    {

        return view($this->view . 'booking-operasi.create')
            ->with([
                'title' => 'Booking Operasi',
                'dokters' => $this->dokterService->byBedahOperasi(), //dokter bedah kebutuhan select items dokter
                'ruangans' => RuanganOperasi::pluck('nama_ruang', 'id') //ruangan operasi kebuthunan select items ruangan
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $this->bookingOperasiService->insert($request->validated());

            return redirect()->back()->with('success', 'Booking berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan booking: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return redirect()->route('operasi.booking.index')
            ->with([
                'booking_id' => $id
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, $id)
    {
        try {
            $this->bookingOperasiService->update($id, $request->validated());

            return redirect()->back()->with('success', 'Booking berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan booking: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::connection('pku')->table('ok_booking_operasi')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
