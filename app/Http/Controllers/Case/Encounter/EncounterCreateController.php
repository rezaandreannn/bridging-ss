<?php

namespace App\Http\Controllers\Case\Encounter;

use App\Http\Controllers\Controller;
use App\Models\Mapping\MappingEncounter;
use App\Models\Pendaftaran;
use App\Services\SatuSehat\PatientService;
use Illuminate\Http\Request;

class EncounterCreateController extends Controller
{
    protected $pendaftaran;
    protected $patientService;
    protected $mappingEncounter;
    public function __construct()
    {
        $this->pendaftaran = new Pendaftaran();
        $this->patientService = new PatientService();
        $this->mappingEncounter = new MappingEncounter();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $noReg)
    {
        // dd($noReg);
        // fetch detail by no reg
        $detailPendaftaran = $this->pendaftaran->getByKodeReg($noReg);
        //   check nik and kode dokter
        if (empty($detailPendaftaran['nik'])) {
            $errorMessage = 'nik data is not available.';
            return redirect()->back()->with('error', $errorMessage);
        }

        if (empty($detailPendaftaran['kode_dokter'])) {
            $errorMessage = 'Sorry, the patient you are looking for is not registered with any doctor or the search results are ambiguous.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // get nik & kode dokter
        $nik = $detailPendaftaran['nik'];
        $kodeDokter = $detailPendaftaran['kode_dokter'];
        // fetch pasien API by nik
        $patient =  $this->patientService->getRequest('Patient', ['identifier' => $nik]);
        if (empty($patient['entry'])) {
            $errorMessage = 'The patient has not been registered in SatuSehat.';
            return redirect()->back()->with('error', $errorMessage);
        }
        // get name and ihs number/id
        $patientId = $patient['entry'][0]['resource']['id'];
        $patientName = $patient['entry'][0]['resource']['name'][0]['text'];
        // fetch mapping encounter by kode dokter
        $mapEncounter = $this->mappingEncounter->where('kode_dokter', $kodeDokter)->first();
        if (empty($mapEncounter)) {
            $errorMessage = 'Mapping Encounter is not available.';
            return redirect()->back()->with('error', $errorMessage);
        }
        if ($mapEncounter->status == false) {
            $errorMessage = 'Map Encounter By' . $mapEncounter->practitioner_display . 'status is inactive.';
            return redirect()->back()->with('error', $errorMessage);
        }
        // get practitioner
        $practitionerIhs = $mapEncounter->practitioner_ihs;
        $practitionerName = $mapEncounter->practitioner_display;
        // get organization ID
        $organizationId = $mapEncounter->organization_id;
        // get Location 
        $locationId = $mapEncounter->location_id;
        $locationName = $mapEncounter->location_display;

        $result = [
            'kodeReg' => $noReg,
            'patientId' => $patientId,
            'patientName' => $patientName,
            'practitionerIhs' => $practitionerIhs,
            'practitionerName' => $practitionerName,
            'organizationId' => $organizationId,
            'locationId' => $locationId,
            'locationName' => $locationName
        ];

        //    redirect view
        return view('pages.encounter.create', compact('result'));
    }
}
