<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationByParts;
use App\Services\SatuSehat\LocationService;
use App\Services\SatuSehat\OrganizationService;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationController extends Controller
{
    protected $organization;
    protected $prefix;
    protected $endpoint;
    protected $view;
    protected $routeIndex;
    protected $locationService;
    protected $baseService;

    public function __construct()
    {
        $this->organization = new OrganizationService();
        $this->prefix = 'Organization';
        $this->endpoint = 'Organization';
        $this->view = 'pages.md.organization.';
        $this->routeIndex = 'organization.index';
        $this->locationService = new LocationService();
        $this->baseService = new BaseService();
    }
    public function index()
    {
        // $organizations = DB::table('organizations')
        //     ->select('organization_id', DB::raw("MAX(SUBSTRING_INDEX(part_of, '/', -1)) AS part_of_id"))
        //     ->groupBy('organization_id')
        //     ->get();
        // dd($organizations);
        $title = $this->prefix . ' ' . 'Index';
        $organizations = Organization::all();
        return view($this->view . 'index', compact('title', 'organizations'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $organizations = Organization::select('organization_id', 'name')->get();
        return view($this->view . 'create', compact('title', 'organizations'));
    }

    public function store(Request $request)
    {
        $body = [
            'name' => $request->name,
            'part_of' => $request->part_of
        ];

        try {
            // send API 
            $data = $this->organization->postRequest($this->endpoint, $body);

            // Send DB
            $organization =  Organization::create([
                'organization_id' => $data['id'],
                'name' => $data['name'],
                'part_of' => $data['partOf']['reference'] ?? '',
                'created_by' => 'system'
            ]);

            $message = 'New item has been created successfully.';
            if ($request->modal == 'modal') {
                return redirect()->back()->with('toast_success', $message);
            }
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function show($organization_id)
    {
        $title = 'Detail' . ' ' . $this->prefix;

        $organization = Organization::where('organization_id', $organization_id)->first();
        $dataById =  $this->organization->getRequest($this->endpoint . '/' . $organization_id);

        $locationByOrganizationId = $this->locationService->getRequest(
            'Location',
            ['organization' => $organization_id]
        );

        $locationByOrganizationIdEntries = collect($locationByOrganizationId['entry']);

        $organizationbyParts = $this->organization->getRequest($this->endpoint, [
            'partOf' => $organization_id
        ]);

        $organizationEntries =  collect($organizationbyParts['entry']);

        // $collection = collect($organizationEntries);
        $perPage = 5;

        $page = request()->input('page', 1);

        $locationByOrganizationId = $this->baseService->paginate($locationByOrganizationIdEntries, $perPage, $page);


        $organizationbyParts = $this->baseService->paginate($organizationEntries, $perPage, $page);

        return view($this->view . 'detail', compact('dataById', 'title', 'organizationbyParts', 'locationByOrganizationId'));
    }

    public function edit($organization_id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $organization = Organization::where('organization_id', $organization_id)->first();
        $organizations = Organization::select('organization_id', 'name')->get();
        return view($this->view . 'edit', compact('title', 'organization', 'organizations'));
    }

    public function update($organization_id, Request $request)
    {
        $organization = Organization::where('organization_id', $organization_id)->first();
        $body = [
            'id' => $organization->organization_id,
            'name' => $request->name,
            'part_of' => $request->part_of ?? ''
        ];

        $url = $this->endpoint . '/' . $body['id'];

        try {
            // send API 
            $data = $this->organization->patchRequest($url, $body);

            // Send DB
            $organization->update([
                'organization_id' => $data['id'],
                'name' => $data['name'],
                'part_of' => $data['partOf']['reference'] ?? '',
                'created_by' => 'system'
            ]);

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}
