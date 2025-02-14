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
use App\Services\MasterData\UserService;
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


        $date = date('Y-m-d');
        if ($request->input('tanggal') != null) {
            $date = $request->input('tanggal');
        }


        $bookings = [];
        $statusPendaftaran = null;

        $user = auth()->user();

        if ($user->hasRole('perawat poli') || $user->hasRole('perawat poli mata') || $user->hasRole('perawat igd')) {

            $kode_dokter = $request->input('kode_dokter');

            if ($kode_dokter) {

                $sessionBangsal = null;
                $bookings = $this->bookingOperasiService->byDate($date, $sessionBangsal, $kode_dokter);
                // cek apakah status aktif
                $statusPendaftaran = BookingHelper::getStatusPendaftaran($bookings);
            }
        } elseif ($user->hasRole('perawat bangsal')) {
            // dd('ok');
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            $bookings = $this->bookingOperasiService->byDate($date, $sessionBangsal);
            $statusPendaftaran = BookingHelper::getStatusPendaftaran($bookings);
        }
        // $statusPendaftaran = BookingHelper::getStatusPendaftaran($bookings);
        $booking = null;
        if (session('booking_id')) {
            $booking = $this->bookingOperasiService->findById(session('booking_id'));
        }

        $pasien = $this->pasienService->byStatusActive2();
        // dd($pasien);
        // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
        // $statusPenandaan = BookingHelper::getStatusPenandaan($bookings);
        // dd($this->pasienService->byStatusActive());

        return view($this->view . 'booking-operasi.index', compact('bookings', 'booking', 'pasien'))->with([

            'title' => $title,
            'ruanganOperasi' => RuanganOperasi::all(),
            'statusPendaftaran' => $statusPendaftaran,
            'dokters' => $this->dokterService->byBedahOperasi(),

            'filterbooking' =>  response()->json([
                'bookings' => $bookings
            ])
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
                'asal_ruangan' => $request->input('asal_ruangan'),
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
