<?php

namespace App\Http\Controllers\Encounter;

use App\DTO\EncounterDTO;
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
    protected $encounterDTO;

    public function __construct(Encounter $encounter)
    {
        $this->view = 'pages.encounter.';
        $this->routeIndex = 'resource.index';
        $this->prefix = 'Encounter';
        $this->encounter = $encounter;
        $this->practitionerService = new PracticionerService();
        $this->encounterDTO = new EncounterDTO();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';

        // Retrieve parameters from the request
        $kode_dokter = $request->input('dokter_code');
        $created_at = $request->input('created_at');
        $class_code = $request->input('class_code');

        if (empty($created_at)) {
            $created_at = now()->format('Y-m-d');
        }

        // $encounters = Encounter::query();
        $encounters = Encounter::whereDate('created_at', $created_at)->get();
        // Add filter for kode_dokter if it's not empty
        if (!empty($kode_dokter)) {
            // Get nik by kode dokter
            $dokterModel = new Dokter();
            $nik = $dokterModel->getNik($kode_dokter);

            // Find ihs number by kode dokter
            $practitioner = $this->practitionerService->getRequest('Practitioner', ['identifier' => $nik]);

            // Check if practitioner data is available
            if (!empty($practitioner['entry'][0]['resource']['id'])) {
                $ihsPractitioner = $practitioner['entry'][0]['resource']['id'];

                // Add filter for practitioner IHS
                // Retrieve encounters by practitioner IHS and created date
                $encounters = Encounter::where('practitioner_ihs', $ihsPractitioner)
                    ->where('class_code', $class_code)
                    ->whereDate('created_at', $created_at)
                    ->get();
            }
        }

        // Add filter for created_at if it's not empty
        // if (!empty($created_at)) {
        //     $encounters->whereDate('created_at', $created_at);
        // }

        // Add filter for class_code if it's not empty
        if (!empty($class_code)) {
            $encounters->where('class_code', $class_code);
        }

        // Retrieve encounters based on the applied filters
        // Panggil metode model untuk filter data
        $dokters = $this->encounter->byKodeDokter();
        $getClass = $this->encounterDTO->getClass();

        return view($this->view . 'index', compact('encounters', 'dokters', 'title', 'getClass'));
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
