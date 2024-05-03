<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\JenisFisio;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class JenisFisioController extends Controller
{
    protected $jenisFisio;
    protected $view;
    protected $httpClient;
    protected $simrsUrlApi;
    protected $prefix;


    public function __construct(JenisFisio $jenisFisio)
    {
        $this->jenisFisio = $jenisFisio;
        $this->view = 'pages.md.jenisFisio.';
        $this->prefix = 'Jenis Fisio';
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    public function index()
    {
        $jenis = $this->jenisFisio->getDataJenisFisio();
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'index', compact('title', 'jenis'));
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
        $validatedData = $request->validate([
            'NAMA_TERAPI' => 'required',
        ]);

        $response = $this->httpClient->post($this->simrsUrlApi . 'fisioterapi/master/jenisFisio/add', [
            'json' => [
                'NAMA_TERAPI' => $request->input('NAMA_TERAPI'),
            ]
        ]);

        $responseData = $response->getBody()->getContents();

        return redirect()->back()->with('success', 'Jenis Terapi Berhasil Ditambahkan!');
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
    public function update(Request $request, $ID_JENIS_FISIO)
    {
        $validatedData = $request->validate([
            'NAMA_TERAPI' => 'required',
        ]);

        $response = $this->httpClient->put($this->simrsUrlApi . 'fisioterapi/master/jenisFisio/update/' . $ID_JENIS_FISIO, [
            'json' => [
                'NAMA_TERAPI' => $request->input('NAMA_TERAPI'),
            ]
        ]);

        return redirect()->back()->with('success', 'Jenis Terapi Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_JENIS_FISIO)
    {
        $response = $this->httpClient->delete($this->simrsUrlApi . 'fisioterapi/master/jenisFisio/delete/' . $ID_JENIS_FISIO);

        return redirect()->back()->with('success', 'Jenis Terapi Berhasil Dihapus!');
    }
}
