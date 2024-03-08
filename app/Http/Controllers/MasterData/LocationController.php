<?php

namespace App\Http\Controllers\MasterData;

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

        return view($this->view . 'create', compact('title', 'organizations'));
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
