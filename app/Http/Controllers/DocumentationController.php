<?php

namespace App\Http\Controllers;

use App\DTO\LocationDTO;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.docs.';
        $this->prefix = 'Documentation';
    }

    public function index()
    {
        return view('pages.docs.index');
    }

    public function location()
    {
        $title = $this->prefix . ' ' . 'Location';
        $l_identifier     = LocationDTO::getIdentifierUse();
        $l_status         = LocationDTO::getStatus();
        $l_operational    = LocationDTO::getOperationalStatus();
        $l_modes          = LocationDTO::getModes();
        $l_system         = LocationDTO::getTelecomSystem();
        $l_use            = LocationDTO::getTelecomUse();
        $l_addressUse     = LocationDTO::getAddressUse();
        $l_addressType    = LocationDTO::getAddressType();
        $l_physical       = LocationDTO::getPhysicalTypes();
        $l_daysofweek     = LocationDTO::getDaysOfWeek();
        $l_serviceClass   = LocationDTO::getServiceClass();
        $l_type           = LocationDTO::getType();
        return view($this->view . 'location', compact('title', 'l_identifier', 'l_status', 'l_operational', 'l_modes', 'l_system', 'l_use', 'l_addressUse', 'l_addressType', 'l_physical', 'l_daysofweek', 'l_serviceClass', 'l_type'));
    }

    public function organization()
    {
        $title = $this->prefix . ' ' . 'Organization';
        return view($this->view . 'organization', compact('title'));
    }

    public function encounter()
    {
        $title = $this->prefix . ' ' . 'Encounter';
        return view($this->view . 'encounter', compact('title'));
    }
}
