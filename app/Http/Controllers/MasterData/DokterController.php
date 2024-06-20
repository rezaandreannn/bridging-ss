<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Services\SatuSehat\PracticionerService;

class DokterController extends Controller
{
    protected $dokter;
    protected $practicionerSatuSehat;
    protected $endpoint;
    protected $viewPath;


    public function __construct(Dokter $dokter)
    {
        $this->dokter = $dokter;
        $this->practicionerSatuSehat = new PracticionerService();
        $this->endpoint = 'Practitioner';
        $this->viewPath = 'pages.md.dokter.';
    }

    public function index(Request $request)
    {
        $title = 'Dokter';
        $data = $this->dokter->getData();
        return view('pages.md.dokter.index', ['data' => $data]);
    }

    public function edit($kodeDokter)
    {
        try {
            $dokterData = $this->dokter->getByKodeDokter($kodeDokter);
            // Assuming you want to return the edit form view with doctor data
            return view('pages.md.dokter.edit', ['dokter' => $dokterData]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the API request
            // For example, you could redirect to an error page
            return redirect()->route('error')->with('error', $e->getMessage());
        }
    }

    // public function show($kodeDokter)
    // {
    //     try {
    //         $params = [
    //             'identifier' => $this->dokter->getNik($kodeDokter)
    //         ];
    //         // kirem data ke satu sehat berdasarkan nik
    //         $practitionerSatuSehat = $this->practicionerSatuSehat->getRequest($this->endpoint, $params);

    //         // Menggunakan model Dokter untuk mencari data berdasarkan kode dokter
    //         $dokter = $this->dokter->getByKodeDokter($kodeDokter);
    //         return view($this->viewPath . 'detail', compact('dokter'));
    //     } catch (\Exception $e) {
    //         // Handle any exceptions that occur during the API request
    //         $errorMessage = "Error: " . $e->getMessage();
    //         return redirect()->back()->with('error', $errorMessage);
    //     }
    // }

    public function show($kodeDokter)
    {
        // $pasiens =  DB::connection('db_rsmm')->table('DOKTER')->where('NAMA_DOKTER', $kodeDokter)->first();
        $dokter = $this->dokter->getByKodeDokter($kodeDokter);
        return view($this->viewPath . 'detail', compact('dokter'));
    }
}
