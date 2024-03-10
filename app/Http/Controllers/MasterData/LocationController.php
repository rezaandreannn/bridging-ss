<?php

namespace App\Http\Controllers\MasterData;

use App\DTO\LocationDTO;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\BaseService;
use App\Services\SatuSehat\LocationService;

class LocationController extends Controller
{

    protected $prefix;
    protected $endpoint;
    protected $view;
    protected $routeIndex;
    protected $locationService;
    protected $baseService;

    public function __construct()
    {
        $this->prefix = 'Location';
        $this->endpoint = 'Location';
        $this->view = 'pages.md.location.';
        $this->routeIndex = 'location.index';
        $this->locationService = new LocationService();
        $this->baseService = new BaseService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';

        $locations = Location::all();

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
            'coding_code' => $dataType['coding_display'],
            'coding_display' => $dataType['coding_display'],
            'organization_id' => $request->organization_id,
            'description' => $request->description,
        ];

        if ($request->filled('part_of')) {
            $body['part_of'] = $request->part_of;
        }
        dd($body);
    }

    public function show($locationId)
    {
        $title = 'Detail' . ' ' . $this->prefix;
        Location::where('location_id', $locationId)->first();
        $dataById =  $this->locationService->getRequest($this->endpoint . '/' . $locationId);
        return $dataById;

        return view($this->view . 'detail', compact('title'));
    }
}
