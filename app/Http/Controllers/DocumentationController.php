<?php

namespace App\Http\Controllers;

use App\DTO\LocationDTO;
use App\DTO\EncounterDTO;
use App\DTO\OrganizationDTO;
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
        $o_identifier     = OrganizationDTO::getIdentifierUse();
        $o_type           = OrganizationDTO::getTypes();
        $o_system         = OrganizationDTO::getTelecomSystem();
        $o_use            = OrganizationDTO::getTelecomUse();
        $o_addressUse     = OrganizationDTO::getAddressUse();
        $o_addressType    = OrganizationDTO::getAddressType();
        $o_contact        = OrganizationDTO::getContactPurpose();
        return view($this->view . 'organization', compact('title', 'o_identifier', 'o_type', 'o_system', 'o_use', 'o_addressUse', 'o_addressType', 'o_contact'));
    }

    public function encounter()
    {
        $title = $this->prefix . ' ' . 'Encounter';
        $e_identifier       = EncounterDTO::getIdentifierUse();
        $e_status           = EncounterDTO::getStatusEncounter();
        $e_statusHistory    = EncounterDTO::getStatusHistory();
        $e_class            = EncounterDTO::getClass();
        $e_classHistory     = EncounterDTO::getClassHistory();
        $e_priority         = EncounterDTO::getPriority();
        $e_participant      = EncounterDTO::getParticipant();
        $e_admit            = EncounterDTO::getadmitSource();
        $e_admission        = EncounterDTO::getreAdmission();
        $e_diet             = EncounterDTO::getdietPreference();
        $e_arrangement      = EncounterDTO::getspecialArrangement();
        $e_dispotion        = EncounterDTO::getdischargeDisposition();
        $e_service          = EncounterDTO::getserviceClass();
        $e_indicator        = EncounterDTO::getupgradeClassIndicator();
        return view($this->view . 'encounter', compact('title', 'e_identifier', 'e_status', 'e_statusHistory', 'e_class', 'e_classHistory', 'e_priority', 'e_participant', 'e_admit', 'e_admission', 'e_diet', 'e_arrangement', 'e_dispotion', 'e_service', 'e_indicator'));
    }
}
