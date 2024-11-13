<?php

namespace App\Http\Controllers\OK;

use Exception;
use App\Models\RajalDokter;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SimRs\DokterService;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\RuanganOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Http\Requests\Operasi\StoreBookingRequest;

class BookingOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingkamar;
    protected $rajaldokter;

    // menggunakan service
    protected $bookingOperasiService;
    protected $dokterService;

    public function __construct(BookingOperasi $bookingkamar)
    {
        $this->rajaldokter = new RajalDokter;
        $this->bookingkamar = $bookingkamar;
        $this->view = 'pages.ok.';
        $this->prefix = 'Booking Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->dokterService = new DokterService();
    }

    public function index()
    {
        // variable declare
        $title = $this->prefix . ' ' . 'List';

        // get data from service
        $bookings = $this->bookingOperasiService->get();

        return view($this->view . 'booking-operasi.index', compact('bookings'))->with([
            'title' => $title,
            'ruanganOperasi' => RuanganOperasi::all(),
            'dokters' => $this->dokterService->byBedahOperasi(),
        ]);
    }

    public function create()
    {

        return view($this->view . 'booking-operasi.create')
            ->with([
                'title' => 'Booking Operasi',
                'dokters' => $this->dokterService->byBedahOperasi(), //dokter bedah kebutuhan select items dokter
                'ruangans' => RuanganOperasi::pluck('nama', 'id') //ruangan operasi kebuthunan select items ruangan
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
