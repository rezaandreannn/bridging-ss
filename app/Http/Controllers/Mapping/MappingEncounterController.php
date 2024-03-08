<?php

namespace App\Http\Controllers\Mapping;

use App\Http\Controllers\Controller;
use App\Models\Mapping\MappingEncounter;
use App\Models\Organization;
use Illuminate\Http\Request;

class MappingEncounterController extends Controller
{
    protected $viewPath;
    public function __construct()
    {
        $this->viewPath = 'pages.mapping.encounter.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->viewPath . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Mapping Encounter';

        $encounterTypes = MappingEncounter::TYPE;

        $organizations = Organization::where('name', 'like', '%rawat jalan%')
            ->orWhere('name', 'like', '%igd%')
            ->pluck('name', 'organization_id');


        // dd($organization);

        return view($this->viewPath . 'create', compact('title', 'encounterTypes', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function show(MappingEncounter $mappingEncounter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function edit(MappingEncounter $mappingEncounter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MappingEncounter $mappingEncounter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapping\MappingEncounter  $mappingEncounter
     * @return \Illuminate\Http\Response
     */
    public function destroy(MappingEncounter $mappingEncounter)
    {
        //
    }
}
