<?php

namespace App\Http\Controllers\Mapping;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Location;
use App\Models\Mapping\MappingEncounter;
use App\Models\Organization;
use App\Services\SatuSehat\LocationService;
use App\Services\SatuSehat\PracticionerService;
use Illuminate\Http\Request;

class MappingEncounterController extends Controller
{
    protected $viewPath;
    protected $routeIndex;
    protected $dokter;
    protected $practitionerService;
    protected $locationService;
    protected $prefix;
    public function __construct()
    {
        $this->practitionerService = new PracticionerService();
        $this->locationService = new LocationService();
        $this->dokter = new Dokter();
        $this->routeIndex = 'mapping.encounter.index';
        $this->viewPath = 'pages.mapping.encounter.';
        $this->prefix = 'Mapping';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mappingEncounters = MappingEncounter::all();
        return view($this->viewPath . 'index', compact('mappingEncounters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Mapping Encounter';

        $encounterTypes = MappingEncounter::TYPE;

        $dokters = $this->dokter;

        $organizations = Organization::where('name', 'like', '%rawat jalan%')
            ->orWhere('name', 'like', '%igd%')
            ->pluck('name', 'organization_id');

        $locations = Location::where('name', 'like', '%ruang%')->get();

        return view($this->viewPath . 'create', compact('title', 'encounterTypes', 'organizations', 'locations', 'dokters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // fetch NIK By Kode Dokter
            $kodeDokter = $request->kode_dokter;
            $nik = $this->dokter->getNik($kodeDokter);

            // cek nik ada atau tidak
            if (empty($nik)) {
                return redirect()->back()->with('error', 'NIK data is not available');
            }

            // fetch Pratitioner & display By NIK
            $params = [
                'identifier' => $nik
            ];

            $practitioner = $this->practitionerService->getRequest('Practitioner', $params);
            $practitionerIhs = $practitioner['entry'][0]['resource']['id'];
            $practitionerName = $practitioner['entry'][0]['resource']['name'][0]['text'];

            // fetch Location by LocationID 
            $location = $this->locationService->getRequest('Location/' . $request->location_id);

            // get LocationId & name
            $locationId = $location['id'];
            $locationName = $location['name'];
            // get organizationID 
            $managingOrganization = $location['managingOrganization']['reference'];
            $organizationByLocation = explode('/', $managingOrganization);
            $organizationId = $organizationByLocation[1];

            // insert DB
            MappingEncounter::create([
                'kode_dokter' => $kodeDokter,
                'practitioner_ihs' => $practitionerIhs,
                'practitioner_display' => $practitionerName,
                'location_id' => $locationId,
                'location_display' => $locationName,
                'organization_id' => $organizationId,
                'type' => $request->type,
                'status' => $request->status ? true : false,
                'created_by' => auth()->user()->id ?? ''
            ]);
            $message = 'Data has been created successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function show(MappingEncounter $mappingEncounter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Mapping Encounter';

        $encounter = MappingEncounter::findOrFail($id);
        $encounterTypes = MappingEncounter::TYPE;
        $organizations = Organization::where('name', 'like', '%rawat jalan%')
            ->orWhere('name', 'like', '%igd%')
            ->pluck('name', 'organization_id');
        $locations = Location::where('name', 'like', '%ruang%')->get();
        $dokters = $this->dokter;
        return view($this->viewPath . 'edit', compact('title', 'encounterTypes', 'encounter', 'dokters', 'organizations', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Fetch the MappingEncounter record to be updated
        $mappingEncounter = MappingEncounter::findOrFail($id);

        // Update the attributes based on the incoming request
        $mappingEncounter->kode_dokter = $request->doctor;
        $mappingEncounter->location_id = $request->location;
        $mappingEncounter->type = $request->encounter_type;
        $mappingEncounter->status = $request->has('status');

        // Save the changes
        $mappingEncounter->save();

        $message = 'Data has been updated successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function destroy(MappingEncounter $mappingEncounter)
    {
        //
    }
}
