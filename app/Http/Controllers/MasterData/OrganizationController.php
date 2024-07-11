<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Location;
use App\DTO\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
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
    protected $organizations;

    public function __construct(Organization $organization)
    {
        $this->organization = new OrganizationService();
        $this->prefix = 'Organization';
        $this->endpoint = 'Organization';
        $this->view = 'pages.md.organization.';
        $this->routeIndex = 'organization.index';
        $this->locationService = new LocationService();
        $this->baseService = new BaseService();
        $this->organizations = new Organization;
    }
    public function index()
    {
        // $organizations = DB::table('organizations')
        //     ->select('organization_id', DB::raw("MAX(SUBSTRING_INDEX(part_of, '/', -1)) AS part_of_id"))
        //     ->groupBy('organization_id')
        //     ->get();
        // dd($organizations);
        $title = $this->prefix . ' ' . 'Index';
        // $organizations = Organization::all();

        $organizations = $this->organizations->getData();
        return view($this->view . 'index', compact('title', 'organizations'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;

        $organizationType = OrganizationDTO::getTypes();

        $organizations = Organization::select('organization_id', 'name')->get();
        return view($this->view . 'create', compact('title', 'organizations', 'organizationType'));
    }

    public function store(Request $request)
    {
        // cari data organization type
        foreach (OrganizationDTO::getTypes() as $type) {
            if ($type['coding_code'] == $request->type_code) {
                $dataType = $type;
            }
        }

        $body = [
            'identifier_value' => $request->identifier_value,
            'name' => $request->name,
            'coding_code' => $dataType['coding_code'],
            'coding_display' => $dataType['coding_display'],
            'active' => $request->active ? true : false
        ];

        if ($request->filled('part_of')) {
            $body['part_of'] = $request->part_of;
        }

        try {
            // send API 
            $data = $this->organization->postRequest($this->endpoint, $body);

            // Send DB
            // $organization =  Organization::create([
            //     'organization_id' => $data['id'],
            //     'active' => $data['active'],
            //     'name' => $data['name'],
            //     'part_of' => $body['part_of'] ?? '',
            //     'created_by' => auth()->user()->id ?? 'system'
            // ]);

            $data = DB::connection('bridging')->table('satusehat_organization')->insert([
                'organization_id' => $data['id'],
                'active' => $data['active'],
                'name' => $data['name'],
                'part_of' => $body['part_of'] ?? '',
                'created_by' => auth()->user()->id ?? 'system'
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

        // $organization = Organization::select('organizations.*', 'users.name as user_name')
        //     ->leftJoin('users', 'organizations.created_by', '=', 'users.id')
        //     ->where('organizations.organization_id', $organization_id)
        //     ->first();

        $organization = DB::connection('bridging')
            ->table('satusehat_organization as a')
            ->leftJoin('users as b', 'a.created_by', '=', 'b.id')
            ->select(
                'a.*',
                'b.name as user_name'
            )
            ->where('organization_id', $organization_id)
            ->first();



        $organizationbyParts = Organization::where('part_of', $organization_id)->get();

        $locationByOrganization = Location::where('organization_id', $organization_id)->get();

        $organizationType = OrganizationDTO::getTypes();

        return view($this->view . 'detail', compact('organization', 'title', 'organizationbyParts', 'locationByOrganization', 'organizationType'));
    }

    public function edit($organization_id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $organization = Organization::where('organization_id', $organization_id)->first();

        // get identifier value 
        $data =  $this->organization->getRequest($this->endpoint . '/' . $organization_id);
        $identifierValue = $data['identifier'][0]['value'];
        $typeCode = $data['type'][0]['coding'][0]['code'];

        $organizationType = OrganizationDTO::getTypes();

        $organizations = Organization::select('organization_id', 'name')->get();

        return view($this->view . 'edit', compact('title', 'organization', 'organizations', 'identifierValue', 'organizationType', 'typeCode', 'data'));
    }

    public function update($organization_id, Request $request)
    {
        $organization = Organization::where('organization_id', $organization_id)->first();
        // cari data organization type
        foreach (OrganizationDTO::getTypes() as $type) {
            if ($type['coding_code'] == $request->type_code) {
                $dataType = $type;
            }
        }

        $body = [
            'id' => $organization->organization_id,
            'identifier_value' => $request->identifier_value,
            'name' => $request->name,
            'coding_code' => $dataType['coding_code'],
            'coding_display' => $dataType['coding_display'],
            'active' => $request->active ? true : false
        ];

        if ($request->filled('part_of')) {
            $body['part_of'] = $request->part_of;
        }

        // $body = [
        //     'id' => $organization->organization_id,
        //     'name' => $request->name,
        //     'part_of' => $request->part_of ?? ''
        // ];

        $url = $this->endpoint . '/' . $body['id'];

        try {
            // send API 
            $data = $this->organization->patchRequest($url, $body);

            // Send DB
            // $organization->update([
            //     'organization_id' => $data['id'],
            //     'active' => $data['active'],
            //     'name' => $data['name'],
            //     'part_of' => $body['part_of'] ?? '',
            //     'updated_by' => auth()->user()->id ?? 'system'
            // ]);

            $data = DB::connection('bridging')->table('satusehat_organization')->where('organization_id', $organization_id)->update([
                'active' => $data['active'],
                'name' => $data['name'],
                'part_of' => $body['part_of'] ?? '',
                'updated_by' => auth()->user()->id ?? 'system'
            ]);

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}
