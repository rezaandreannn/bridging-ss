<?php

namespace App\Http\Controllers\Farmasi;

use App\Models\Farmasi;
use Illuminate\Http\Request;
use App\Models\BerkasFisioterapi;
use App\Http\Controllers\Controller;

class OrderAlkesController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $ranap;
    protected $farmasi;

    public function __construct(Farmasi $farmasi)
    {
        $this->farmasi = $farmasi;
        $this->view = 'pages.farmasi.';
        $this->prefix = 'Farmasi';
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            //
            
            $title = $this->prefix . ' ' . 'Order Alat Kesehatan';
            $tanggal = date('Y-m-d');
            if($request->input('tanggal') != null){
                $tanggal = $request->input('tanggal');
            }
            $pasienAlkes = $this->farmasi->getFisioterapAlkes($tanggal);
            $berkasfisio = new BerkasFisioterapi();
            $masterHargaAlkes = $this->farmasi->getMasterHargaAlkes();
            // dd($masterHargaAlkes);
    
    
            return view($this->view . 'order_alkes.index', compact('title','pasienAlkes','berkasfisio','masterHargaAlkes'));
        //
    }

    public function harga_alkes_by_ukuran_alat(Request $request)
    {
        $id = $request->input('ukuran');

        $harga_alkes = $this->farmasi->getHargaAlkes($id);
        //$data .= "<option>--Pilih Alasan--</option>";
        // return json_encode($harga_alkes);
        return response()->json([
            'data' => $harga_alkes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
