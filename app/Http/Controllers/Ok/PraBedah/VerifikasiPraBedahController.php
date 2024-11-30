<?php

namespace App\Http\Controllers\Ok\PraBedah;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\Prabedah\StoreVerifikasiPraBedahRequest;
use App\Http\Requests\Operasi\Prabedah\UpdateVerifikasiPraBedahRequest;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PraBedah\VerifikasiPraBedahService;

class VerifikasiPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $verifikasiPraBedahService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Verifikasi Pra Bedah';
        $this->verifikasiPraBedahService = new VerifikasiPraBedahService();

        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        $date = '2024-11-20';
        // get data from service
        $sessionBangsal = 'MNA';
        $bookings = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');
        // dd($bookings);

        return view($this->view . 'verifikasi-prabedah.index', compact('title', 'bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_register)
    {
        $title = $this->prefix . ' ' . 'Input Data';
        $biodata = $this->bookingOperasiService->biodata($kode_register);

        return view($this->view . 'verifikasi-prabedah.create', compact('title', 'biodata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVerifikasiPraBedahRequest $request)
    {
        try {
            $this->verifikasiPraBedahService->insert($request->validated());

            return redirect()->back()->with('success', 'Verifikasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Verifikasi: ' . $e->getMessage());
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
    public function edit($kode_register)
    {
        $title = $this->prefix . ' ' . 'Edit Data';
        $verifikasi = $this->verifikasiPraBedahService->findById($kode_register);
        $biodata = $this->bookingOperasiService->biodata($kode_register);

        return view($this->view . 'verifikasi-prabedah.edit', compact('title', 'biodata', 'verifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVerifikasiPraBedahRequest $request, $kode_register)
    {
        try {
            $this->verifikasiPraBedahService->update($kode_register, $request->validated());

            return redirect()->back()->with('success', 'Verifikasi Pra Bedah berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal merubah verifikasi pra bedah: ' . $e->getMessage());
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
        //
    }
}
