<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Services\SatuSehat\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organization;

    public function __construct()
    {
        $this->organization = new OrganizationService();
    }
    public function index()
    {
        $title = 'Organization';
        return view('pages.md.organization.index', compact('title'));
    }

    public function create()
    {
        $title = 'Create Organization';
        return view('pages.md.organization.create', compact('title'));
    }

    public function store(Request $request)
    {
        $body = [
            'name' => $request->name,
            'part_of' => $request->part_of
        ];

        $send = $this->organization->postRequest('Organization', $body);
        return $send;
    }
}
