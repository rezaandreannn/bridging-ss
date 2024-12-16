<?php

namespace App\Http\Controllers\Ok;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\PreOperasi\StorePreOperasiRequest;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\DataUmum\PreOperasiService;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;

class PreOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $preOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.operasi.pre-operasi.';
        $this->prefix = 'Pre Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->preOperasiService = new PreOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        // get data from service
        $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        $preOperasi = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        return view($this->view . 'index', compact('preOperasi'))
            ->with([
                'title' => $title,
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

        return view($this->view . 'create', compact('biodata'))
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
    public function store(StorePreOperasiRequest $request)
    {
        try {
            $this->preOperasiService->insert($request->validated());

            return redirect('/operasi/pre-operasi')->with('success', 'Pre Operasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan post operasi: ' . $e->getMessage());
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
