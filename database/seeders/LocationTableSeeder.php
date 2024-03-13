<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Services\SatuSehat\LocationService;
use Illuminate\Database\Seeder;



class LocationTableSeeder extends Seeder
{
    protected $location;

    public function __construct()
    {
        $this->location = new LocationService();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // public function bodyRaw()
    // {
    //     $data = [
    //         "resourceType" => "Location",
    //         "identifier" => [
    //             [
    //                 "system" => "http://sys-ids.kemkes.go.id/location/" . env('SATU_SEHAT_ORGANIZATION_ID'),
    //                 "value" => "RSU Muhammadiyah Metro"
    //             ]
    //         ],
    //         "status" => "active",
    //         "name" => "RSU Muhammadiyah Metro",
    //         "description" => "Rumah Sakit Umum Muhammadiyah Metro",
    //         "mode" => "instance",
    //         "telecom" => [
    //             [
    //                 "system" => "phone",
    //                 "value" => "072549490",
    //                 "use" => "work"
    //             ],
    //             [
    //                 "system" => "email",
    //                 "value" => "itrsumm08@gmail.com",
    //                 "use" => "work"
    //             ],
    //             [
    //                 "system" => "url",
    //                 "value" => "https://rsumm.co.id",
    //                 "use" => "work"
    //             ]
    //         ],
    //         "address" => [
    //             "use" => "work",
    //             "line" => [
    //                 "Jl. Soekarno Hatta No. 42 Mulyojati 16B Metro Barat Kota Metro"
    //             ],
    //             "city" => "Kota Metro",
    //             "postalCode" => "34125",
    //             "country" => "ID",
    //             "extension" => [
    //                 [
    //                     "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
    //                     "extension" => [
    //                         [
    //                             "url" => "province",
    //                             "valueCode" => "18"
    //                         ],
    //                         [
    //                             "url" => "city",
    //                             "valueCode" => "1872"
    //                         ],
    //                         [
    //                             "url" => "district",
    //                             "valueCode" => "187203"
    //                         ],
    //                         [
    //                             "url" => "village",
    //                             "valueCode" => "1872031001"
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ],
    //         "physicalType" => [
    //             "coding" => [
    //                 [
    //                     "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
    //                     "code" => "si",
    //                     "display" => "site"
    //                 ]
    //             ]
    //         ],
    //         "managingOrganization" => [
    //             "reference" => "Organization/" . env('SATU_SEHAT_ORGANIZATION_ID')
    //         ]
    //     ];

    //     return $data;
    // }

    public function run()
    {
        $organizationId = env('SATU_SEHAT_ORGANIZATION_ID');

        $result = $this->location->getRequest('Location', ['organization' =>  $organizationId]);

        $data = $result['entry'][0]['resource'];

        $organizationId = $data['managingOrganization']['reference'];
        $parts = explode('/', $organizationId);

        Location::create([
            'location_id' => $data['id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'organization_id' => end($parts),
            'description' => $data['description'],
            'created_by' => 'seeder'
        ]);
    }
}
