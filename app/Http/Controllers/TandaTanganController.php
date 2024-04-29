<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\TandaTangan;
use Illuminate\Http\Request;

class TandaTanganController extends Controller
{

  

    protected $ttd;
    protected $prefix;
    protected $routeIndex;
    protected $viewPath;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(TandaTangan $ttd)
    {
       

        $this->ttd = $ttd;
        $this->viewPath = 'pages.ttd.';
        $this->prefix = 'ttd';
        $this->routeIndex = 'ttd.index';
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Index Tanda Tangan Petugas';
        $ttdPasien = $this->ttd->tandaTanganGet();
     

        return view($this->viewPath . 'index', compact( 'title','ttdPasien'));
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
    public function edit()
    {
        //
             //
             $title = 'Index Tanda Tangan Petugas';
     

             return view($this->viewPath . 'edit', compact( 'title'));
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
    
    public function delete($id_ttd)
    {
        //
     // Make a PUT or PATCH request to the API endpoint to update the data
        $response = $this->httpClient->delete($this->simrsUrlApi . 'fisioterapi/ttd/petugas/delete/' . $id_ttd);
        // Redirect the user back or to a different page after successful submission
        return redirect()->back()->with('success', 'Transaction deleted successfully!');
    }
}
