<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{

    protected $prefix;
    protected $endpoint;
    protected $view;
    protected $routeIndex;

    public function __construct()
    {
        $this->prefix = 'Location';
        $this->endpoint = 'Location';
        $this->view = 'pages.md.location.';
        $this->routeIndex = 'location.index';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';

        return view($this->view . 'index', compact('title'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;

        $organizations = Organization::pluck('name', 'organization_id');

        return view($this->view . 'create', compact('title', 'organizations'));
    }
}
