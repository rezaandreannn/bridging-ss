<?php

namespace App\Http\Controllers\OK;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SimRs\DokterService;
use App\Models\Operasi\RuanganOperasi;
use App\Models\Operasi\PenandaanOperasi;
use App\Services\SimRs\PendaftaranService;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PenandaanOperasiService;
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
    protected $penandaanOperasiService;


    public function __construct()
    {
        $this->view = 'pages.ok.';
        $this->prefix = 'Booking Operasi';
        $this->penandaanOperasiService = new PenandaanOperasiService();
        $this->bookingOperasiService = new BookingOperasiService();
        $this->dokterService = new DokterService();
        $this->pasienService = new PendaftaranService();
    }

    public function index(Request $request)
    {
        // variable declare
        $title = $this->prefix . ' ' . 'List';

        $date = '2024-12-02';
        // get data from service
        $sessionBangsal = 'MNA';
        $bookings = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        $booking = null;
        if (session('booking_id')) {
            $booking = $this->bookingOperasiService->findById(session('booking_id'));
        }

        // dd($bookings);

        // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
        $statusPenandaan = BookingHelper::getStatusPenandaan($bookings);
        // dd($statusPenandaan);

        return view($this->view . 'booking-operasi.index', compact('bookings', 'booking'))->with([
            'title' => $title,
            'ruanganOperasi' => RuanganOperasi::all(),
            'dokters' => $this->dokterService->byBedahOperasi(),
            'pasien' => $this->pasienService->byStatusActive(),
            'statusPenandaan' => $statusPenandaan
        ]);
    }

    public function create()
    {

        return view($this->view . 'booking-operasi.create')
            ->with([
                'title' => 'Booking Operasi',
                'dokters' => $this->dokterService->byBedahOperasi(), //dokter bedah kebutuhan select items dokter
                'ruangans' => RuanganOperasi::pluck('nama_ruang', 'id') //ruangan operasi kebutuhan select items ruangan
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

    public function detail($id)
    {
        $title = $this->prefix . ' ' . 'Detail Pasien Operasi';
        // Ambil data berdasarkan ID
        $penandaan = $this->penandaanOperasiService->findById($id);

        // dd($penandaan);
        $noReg = $penandaan->kode_register;

        // Ambil biodata berdasarkan nomor registrasi
        $biodata = $this->bookingOperasiService->biodata($noReg);
        // dd($biodata);

        return view($this->view . 'booking-operasi.detail', compact('title', 'biodata', 'penandaan'));
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

    public function updateTanggal(Request $request, $id)
    {
        try {
            $booking = $this->bookingOperasiService->findById($id);

            $booking->update([
                'tanggal' => $request->input('tanggal'),
            ]);

            return redirect()->back()->with('success', 'Tanggal berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal mengganti tanggal: ' . $e->getMessage());
        }
    }

    public function updateRuangan(Request $request, $id)
    {
        try {
            $booking = $this->bookingOperasiService->findById($id);

            // dd($booking);
            $booking->update([
                'ruangan_id' => $request->input('ruang_operasi'),
            ]);

            return redirect()->back()->with('success', 'Ruangan berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal mengganti ruangan: ' . $e->getMessage());
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
        try {
            $this->bookingOperasiService->deleteWithRelations($id);
            $feedback = 'success';
            $message = 'Data Berhasil Dihapus!';
        } catch (\Throwable $th) {
            $feedback = 'error';
            $message = 'Data Gagal dihapus';
        }
        return redirect()->back()->with($feedback, $message);
    }
}
