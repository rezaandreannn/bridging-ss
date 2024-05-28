<?php

namespace App\Http\Controllers\MasterData;

use App\DTO\LocationDTO;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SatuSehat\LocationService;

class LocationController extends Controller
{

    protected $prefix;
    protected $endpoint;
    protected $view;
    protected $routeIndex;
    protected $locationService;
    protected $baseService;
    protected $location;

    public function __construct(Location $location)
    {
        $this->prefix = 'Location';
        $this->endpoint = 'Location';
        $this->view = 'pages.md.location.';
        $this->location = new Location;
        $this->routeIndex = 'location.index';
        $this->locationService = new LocationService();
        $this->baseService = new BaseService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';

        $locations = $this->location->getData();

        return view($this->view . 'index', compact('title', 'locations'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;

        $organizations = Organization::pluck('name', 'organization_id');
        $statuses = Location::STATUS;
        $physicalTypes = LocationDTO::getPhysicalTypes();
        $modes = LocationDTO::getModes();
        $locationByParts = Location::pluck('name', 'location_id');

        return view($this->view . 'create', compact('title', 'organizations', 'statuses', 'physicalTypes', 'locationByParts', 'modes'));
    }

    public function store(Request $request)
    {
        foreach (LocationDTO::getPhysicalTypes() as $type) {
            if ($type['coding_code'] == $request->physical_type) {
                $dataType = $type;
            }
        }

        foreach (LocationDTO::getModes() as $mode) {
            if ($mode['mode'] == $request->location_mode) {
                $dataMode = $mode;
            }
        }

        $body = [
            'identifier_value' => $request->identifier_value,
            'name' => $request->name,
            'status' => $request->status,
            'mode' => $dataMode['mode'],
            'coding_code' => $dataType['coding_code'],
            'coding_display' => $dataType['coding_display'],
            'organization_id' => $request->organization_id,
            'description' => $request->description,
        ];

        if ($request->filled('part_of')) {
            $body['part_of'] = $request->part_of;
        }

        // dd($body);

        try {
            // send API
            $data = $this->locationService->postRequest($this->endpoint, $body);

            // send DB
            $data = DB::connection('bridging')->table('satusehat_location')->insert([
                'location_id' => $data['id'],
                'name' => $body['name'],
                'status' => $body['status'],
                'organization_id' => $body['organization_id'],
                'description' => $body['description'],
                'part_of' => $request->part_of ?? '',
                'created_by' => auth()->user()->id
            ]);
            // Location::create([
            //     'location_id' => $data['id'],
            //     'name' => $body['name'],
            //     'status' => $body['status'],
            //     'organization_id' => $body['organization_id'],
            //     'description' => $body['description'],
            //     'part_of' => $request->part_of ?? '',
            //     'created_by' => auth()->user()->id
            // ]);

            $message = 'Data has been created successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function show($locationId)
    {
        $title = 'Detail' . ' ' . $this->prefix;
        Location::where('location_id', $locationId)->first();
        $dataById =  $this->locationService->getRequest($this->endpoint . '/' . $locationId);
        return $dataById;

        return view($this->view . 'detail', compact('title'));
    }

    public function edit($location_id)
    {
        $title = 'Edit' . ' ' . $this->prefix;

        $location = Location::where('location_id', $location_id)->first();
        $dataById =  $this->locationService->getRequest($this->endpoint . '/' . $location_id);

        $partOf = $dataById['partOf']['reference'] ?? '';
        $partOf = explode('/', $partOf);

        $organizationId = $dataById['managingOrganization']['reference'];
        $organizationId = explode('/', $organizationId);

        $data = [
            'location_id' => $location_id,
            'identifier_value' => $dataById['identifier'][0]['value'],
            'name' => $dataById['name'],
            'status' => $dataById['status'],
            'physical_type' => $dataById['physicalType']['coding'][0]['code'],
            'mode' => $dataById['mode'],
            'part_of' => $partOf[1] ?? '',
            'organization_id' => $organizationId[1],
            'description' => $dataById['description']
        ];
        // dd($data);

        $organizations = Organization::pluck('name', 'organization_id');
        $statuses = Location::STATUS;
        $physicalTypes = LocationDTO::getPhysicalTypes();
        $modes = LocationDTO::getModes();
        $locationByParts = Location::pluck('name', 'location_id');

        return view($this->view . 'edit', compact('title', 'organizations', 'statuses', 'physicalTypes', 'locationByParts', 'modes', 'data'));
    }

    public function update(Request $request, $location_id)
    {
        foreach (LocationDTO::getPhysicalTypes() as $type) {
            if ($type['coding_code'] == $request->physical_type) {
                $dataType = $type;
            }
        }

        foreach (LocationDTO::getModes() as $mode) {
            if ($mode['mode'] == $request->location_mode) {
                $dataMode = $mode;
            }
        }

        $location = Location::where('location_id', $location_id)->first();

        $body = [
            'location_id' => $location_id,
            'identifier_value' => $request->identifier_value,
            'name' => $request->name,
            'status' => $request->status,
            'mode' => $dataMode['mode'],
            'coding_code' => $dataType['coding_code'],
            'coding_display' => $dataType['coding_display'],
            'organization_id' => $request->organization_id,
            'description' => $request->description,
        ];

        if ($request->filled('part_of')) {
            $body['part_of'] = $request->part_of;
        }

        try {

            $url = $this->endpoint . '/' . $body['location_id'];
            // send API
            $data = $this->locationService->patchRequest($url, $body);

            $data = DB::connection('bridging')->table('satusehat_location')->where('location_id', $location_id)->update([
                'name' => $body['name'],
                'status' => $body['status'],
                'organization_id' => $body['organization_id'],
                'description' => $body['description'],
                'part_of' => $request->part_of ?? '',
                'updated_by' => auth()->user()->id ?? ''
            ]);

            // send DB
            // $location->update([
            //     'location_id' => $data['id'],
            //     'name' => $body['name'],
            //     'status' => $body['status'],
            //     'organization_id' => $body['organization_id'],
            //     'description' => $body['description'],
            //     'part_of' => $request->part_of ?? '',
            //     'updated_by' => auth()->user()->id ?? ''
            // ]);

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
