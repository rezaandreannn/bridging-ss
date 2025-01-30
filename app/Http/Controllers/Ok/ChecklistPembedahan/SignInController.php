<?php

namespace App\Http\Controllers\Ok\ChecklistPembedahan;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\ChecklistPembedahan\ChecklistPembedahanSignInService;
use App\Http\Requests\Operasi\ChecklistPembedahan\SignIn\StorePembedahanSignRequest;
use App\Http\Requests\Operasi\ChecklistPembedahan\SignIn\UpdatePembedahanSignRequest;

class SignInController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pembedahanSignIn;
    protected $bookingOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.checklist-pembedahan.';
        $this->prefix = 'Check List Pembedahan';
        $this->pembedahanSignIn = new ChecklistPembedahanSignInService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Sign In';
        // $date = '2024-12-05';
        $today = Carbon::today();

        // $checklist = [];
        // // Cek jika login sebagai userbangsal
        // if (auth()->user()->hasRole('perawat bangsal')) {
        //     $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        //     // Ambil pasien bangsal
        //     $checklist = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '', '');
        // }
        // // Cek jika login sebagai dokter
        // elseif (auth()->user()->hasRole('dokter bedah')) {
        //     $sessionKodeDokter = auth()->user()->username ?? null;
        //     // Ambil pasien dokter
        //     $checklist = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
        // }

        $checklist = $this->bookingOperasiService->byDate($today);
        $statusSign = BookingHelper::getStatusPembedahanSignIn($checklist);

        return view($this->view . 'signin.index', compact('checklist'))
            ->with([
                'title' => $title,
                'statusSign' => $statusSign
            ]);
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
        // dd($biodata);

        return view($this->view . 'signin.create', compact('biodata'))
            ->with([
                'title' => $title,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePembedahanSignRequest $request)
    {
        try {
            $this->pembedahanSignIn->insert($request->validated());

            return redirect('/ibs/checklist-pembedahan-signin/')->with('success', 'Checklist Sign In berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Sign In: ' . $e->getMessage());
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
        $sign = $this->pembedahanSignIn->findById($kode_register);
        // dd($preOperasi);
        $biodata = $this->bookingOperasiService->biodata($kode_register);

        return view($this->view . 'signin.edit', compact('title', 'biodata', 'sign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembedahanSignRequest $request, $kode_register)
    {
        try {
            $this->pembedahanSignIn->update($kode_register, $request->validated());

            return redirect('/ibs/checklist-pembedahan-signin/')->with('success', 'Checklist Sign In berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal merubah Checklist Sign: ' . $e->getMessage());
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
