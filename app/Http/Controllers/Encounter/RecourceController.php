<?php

namespace App\Http\Controllers\Encounter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Encounter;
use App\Services\SatuSehat\PracticionerService;
use Illuminate\Http\Request;

class RecourceController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $encounter;
    protected $practitionerService;

    public function __construct(Encounter $encounter)
    {
        $this->view = 'pages.encounter.';
        $this->routeIndex = 'resource.index';
        $this->prefix = 'Encounter';
        $this->encounter = $encounter;
        $this->practitionerService = new PracticionerService();
    }

    public function index(Request $request)
    {
        // Filter

        $title = $this->prefix . ' ' . 'Index';

        // Ambil kode dokter dan tanggal dari request
        $kode_dokter = $request->input('dokter_code');

        if (!empty($kode_dokter)) {
            // get nik by kode dokter
            $dokterModel = new Dokter();
            $nik = $dokterModel->getNik($kode_dokter);
            // find ihs number by kode dokter
            $Practitioner = $this->practitionerService->getRequest('Practitioner', ['identifier' => $nik]);
            $ihsPractitioner = $Practitioner['entry'][0]['resource']['id'];
            $encounterByDokter = Encounter::where('practitioner_ihs', $ihsPractitioner)->get();
        }

        $created_at = $request->input('tanggal');


        // Panggil metode model untuk filter data
        $dokters = $this->encounter->byKodeDokter();
        $encounters = Encounter::getData($kode_dokter, $created_at);

        return view($this->view . 'index', compact('encounters', 'dokters', 'title'));
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
