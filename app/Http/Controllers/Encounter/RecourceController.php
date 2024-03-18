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
        $title = $this->prefix . ' ' . 'Index';
        // Ambil kode dokter dan tanggal dari request
        $kode_dokter = $request->input('dokter_code');
        $created_at = $request->input('created_at');

        $encounters = [];

        // If both kode_dokter and created_at are empty, set created_at to today's date
        if (empty($kode_dokter) && empty($created_at)) {
            $created_at = now()->format('Y-m-d');
        }

        if (empty($kode_dokter)) {
            // Retrieve all encounters for today if kode_dokter is empty
            $encounters = Encounter::whereDate('created_at', $created_at)->get();
        } else {
            // Get nik by kode dokter
            $dokterModel = new Dokter();
            $nik = $dokterModel->getNik($kode_dokter);

            // Find ihs number by kode dokter
            $practitioner = $this->practitionerService->getRequest('Practitioner', ['identifier' => $nik]);

            // Check if practitioner data is available
            if (!empty($practitioner['entry'][0]['resource']['id'])) {
                $ihsPractitioner = $practitioner['entry'][0]['resource']['id'];

                // Retrieve encounters by practitioner IHS and created date
                $encounters = Encounter::where('practitioner_ihs', $ihsPractitioner)
                    ->whereDate('created_at', $created_at)
                    ->get();
            }
        }
        // Panggil metode model untuk filter data
        $dokters = $this->encounter->byKodeDokter();

        return view($this->view . 'index', compact('encounters', 'dokters', 'title'));
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
