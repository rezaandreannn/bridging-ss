<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SatuSehat\OrganizationService;

class OrganizationController extends Controller
{
    protected $organization;
    protected $prefix;
    public function __construct()
    {
        $this->organization = new OrganizationService();
        $this->prefix = 'Organization';
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
        return view('pages.md.organization.index', compact('title', 'organizations'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $organizations = Organization::select('organization_id', 'name')->get();
        return view('pages.md.organization.create', compact('title', 'organizations'));
    }

    public function store(Request $request)
    {
        $body = [
            'name' => $request->name,
            'part_of' => $request->part_of
        ];

        try {
            // send API 
            $data = $this->organization->postRequest('Organization', $body);

            // Send DB
            $organization =  Organization::create([
                'organization_id' => $data['id'],
                'name' => $data['name'],
                'part_of' => $data['partOf']['reference'] ?? '',
                'created_by' => 'system'
            ]);

            $message = 'Send data succesfully';
            return redirect()->route('organization.index')->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function show($organization_id)
    {
        $title = 'Detail' . ' ' . $this->prefix;
        $organization = Organization::where('organization_id', $organization_id)->first();
        $dataById =  $this->organization->getRequest('Organization/' . $organization_id);

        // return $dataById['address'][0]['line'][0];
        return view('pages.md.organization.detail', compact('dataById', 'title'));
    }

    public function edit($organization_id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $organization = Organization::where('organization_id', $organization_id)->first();
        $organizations = Organization::select('organization_id', 'name')->get();
        return view('pages.md.organization.edit', compact('title', 'organization', 'organizations'));
    }

    public function update($organization_id, Request $request)
    {
        $organization = Organization::where('organization_id', $organization_id)->first();
        $body = [
            'id' => $organization->organization_id,
            'name' => $request->name,
            'part_of' => $request->part_of ?? ''
        ];

        try {
            // send API 
            $data = $this->organization->putRequest('Organization', $body);

            // Send DB
            $organization->update([
                'organization_id' => $data['id'],
                'name' => $data['name'],
                'part_of' => $data['partOf']['reference'] ?? '',
                'created_by' => 'system'
            ]);

            $message = 'Send data succesfully';
            return redirect()->route('organization.index')->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}
