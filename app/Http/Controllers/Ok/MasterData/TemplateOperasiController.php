<?php

namespace App\Http\Controllers\Ok\MasterData;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Models\Operasi\MasterData\TemplateOperasi;
use App\Services\Operasi\MasterData\TemplateOperasiService;
use App\Http\Requests\Operasi\MasterData\StoreTemplateOperasi;

class TemplateOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $templateOperasi;
    protected $templateOperasiService;


    public function __construct(TemplateOperasi $templateOperasi)
    {
        $this->templateOperasi = $templateOperasi;
        $this->templateOperasiService = new TemplateOperasiService;
        $this->view = 'pages.ok.';
        $this->prefix = 'Template';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Operasi';
        $data = $this->templateOperasi->all();
        // dd($data);
        return view($this->view . 'template-operasi.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->prefix . ' ' . 'Input Data';

        return view($this->view . 'template-operasi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplateOperasi $request)
    {
        try {
            $this->templateOperasiService->insert($request->validated());
            return redirect('ibs/template-operasi')->with('success', 'Template Operasi berhasil ditambahkan.');

            // return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan template operasi: ' . $e->getMessage());
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
