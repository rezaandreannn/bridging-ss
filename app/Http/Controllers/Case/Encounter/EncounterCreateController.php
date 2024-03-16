<?php

namespace App\Http\Controllers\Case\Encounter;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Encounter;
use App\Models\Mapping\MappingEncounter;
use App\Services\SatuSehat\EncounterService;
use App\Services\SatuSehat\PatientService;

class EncounterCreateController extends Controller
{
    protected $pendaftaran;
    protected $patientService;
    protected $mappingEncounter;
    protected $encounterService;

    public function __construct()
    {
        $this->pendaftaran = new Pendaftaran();
        $this->patientService = new PatientService();
        $this->mappingEncounter = new MappingEncounter();
        $this->encounterService = new EncounterService();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $noReg)
    {

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
            $errorMessage = 'Map Encounter By' . $mapEncounter->practitioner_display . ' status is inactive.';
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

        $body = [
            'kodeReg' => $noReg,
            'status' => 'arrived',
            'patientId' => $patientId,
            'patientName' => $patientName,
            'practitionerIhs' => $practitionerIhs,
            'practitionerName' => $practitionerName,
            'organizationId' => $organizationId,
            'locationId' => $locationId,
            'locationName' => $locationName,
            'statusHistory' => 'arrived'
        ];

        // cek button is active jika belum send dataa
        $dbEncounter = new Encounter();
        $dbWhere = $dbEncounter->where('kode_register', $noReg)->first();
        if ($dbWhere) {
            return redirect()->back()->with('error', 'Data already exists.');
        }

        try {
            // send API
            $resultApi = $this->encounterService->postRequest('Encounter', $body);

            $serviceProvider = $resultApi['serviceProvider']['reference'];
            $serviceProv = explode('/', $serviceProvider);

            // send DB
            Encounter::create([
                'encounter_id' => $resultApi['id'],
                'kode_register' => $body['kodeReg'],
                'class_code' => $resultApi['class']['code'],
                'patient_ihs'  => $body['patientId'],
                'patient_name'  => $body['patientName'],
                'practitioner_ihs'  => $body['practitionerIhs'],
                'practitioner_name'  => $body['practitionerName'],
                'location_id' => $body['locationId'],
                'service_provider' => end($serviceProv),
                'status' => $body['status'],
                'status_history' => $body['statusHistory'],
                'periode_start' => $resultApi['period']['start'],
                'created_by' => auth()->user()->id ?? ''
            ]);

            $message = 'Encounter data has been created successfully.';
            return redirect()->back()->with('success', $message);
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }

        //    redirect view
        // return view('pages.encounter.create', compact('result'));
    }
}
