<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use App\Services\SatuSehat\AccessToken;
use App\Services\SatuSehat\ConfigSatuSehat;


class LocationTableSeeder extends Seeder
{
    protected $httpClient;
    protected $accessToken;
    protected $config;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->accessToken = new AccessToken();
        $this->config = new ConfigSatuSehat();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function bodyRaw()
    {
        $data = [
            "resourceType" => "Location",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/location/861b3be1-9a10-4cc1-b34d-8d5d23779d54",
                    "value" => "test"
                ]
            ],
            "status" => "active",
            "name" => "test",
            "description" => "test",
            "mode" => "instance",
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => "072549490",
                    "use" => "work"
                ],
                [
                    "system" => "email",
                    "value" => "itrsumm08@gmail.com",
                    "use" => "work"
                ],
                [
                    "system" => "url",
                    "value" => "https://rsumm.co.id",
                    "use" => "work"
                ]
            ],
            "address" => [
                "use" => "work",
                "line" => [
                    "Jl. Soekarno Hatta No. 42 Mulyojati 16B Metro Barat Kota Metro"
                ],
                "city" => "Lampung",
                "postalCode" => "34125",
                "country" => "ID",
                "extension" => [
                    [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension" => [
                            [
                                "url" => "province",
                                "valueCode" => "18"
                            ],
                            [
                                "url" => "city",
                                "valueCode" => "1872"
                            ],
                            [
                                "url" => "district",
                                "valueCode" => "187203"
                            ],
                            [
                                "url" => "village",
                                "valueCode" => "1872031001"
                            ]
                            // [
                            //     "url" => "rt",
                            //     "valueCode" => "1"
                            // ],
                            // [
                            //     "url" => "rw",
                            //     "valueCode" => "2"
                            // ]
                        ]
                    ]
                ]
            ],
            "physicalType" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code" => "ro",
                        "display" => "Room"
                    ]
                ]
            ],
            "position" => [
                "longitude" => -5.1349441,
                "latitude" => 105.2896039,
                "altitude" => 21
            ],
            "managingOrganization" => [
                "reference" => "Organization/861b3be1-9a10-4cc1-b34d-8d5d23779d54"
            ]
        ];

        return $data;
    }

    public function run()
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . 'Location';

        $bodyRaw = $this->bodyRaw();


        $response = $this->httpClient->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => $bodyRaw
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        dd($data);
    }
}
