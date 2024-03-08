<?php

namespace App\Services\SatuSehat;

use GuzzleHttp\Client;

class LocationService
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

    protected function bodyRaw(array $body)
    {
        $data = [
            "resourceType" => "Location",
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "http://sys-ids.kemkes.go.id/organization/" . $this->config->setOrganizationId(),
                    "value" => $body['name']
                ]
            ],
            "active" => true,
            "name" => $body['name'],
            "description" => $body['description'],
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
                [
                    "use" => "work",
                    "type" => "both",
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
                            ]
                        ]
                    ]
                ]
            ],
            "physicalType" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                            "code" => "dept",
                            "display" => "Hospital Department"
                        ]
                    ]
                ]
            ],
            "position" => [
                "longitude" => -6.23115426275766,
                "latitude" => 106.83239885393944,
                "altitude" => 0
            ],
            "managingOrganization" => [
                "reference" => "Organization/10000004"
            ]
        ];

        $additionalData = [];

        // Tambahkan elemen "id" berdasarkan kondisi ke dalam array tambahan
        if (isset($body['id'])) {
            $additionalData["id"] = $body['id'];
        }
        // Tambahkan elemen "partOf" ke dalam array tambahan
        if ($body['part_of']) {
            $additionalData["partOf"] = [
                "reference" => "Organization/" . $body['part_of']
            ];
        }
        // Gabungkan array tambahan ke dalam array utama
        $data = array_merge($data, $additionalData);
        // Tambahkan elemen "active" ke dalam array utama
        $data["active"] = isset($body['id']) ? false : true;

        return $data;
    }

    protected function processParams($params)
    {
        if (isset($params['id'])) {
            $params['id'] = $params['id'];
        }

        if (isset($params['name'])) {
            $params['name'] = $params['name'];
        }

        if (isset($params['partOf'])) {
            $params['partof'] = $params['partOf'];
        }

        return $params;
    }

    public function getRequest($endpoint, $params = [])
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        $params = $this->processParams($params);

        if (!empty($params['partOf'])) {
            $url .= '?' . http_build_query($params);
        }

        $response = $this->httpClient->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        $data = $response->getBody()->getContents();
        return json_decode($data, true);
    }

    public function postRequest($endpoint, array $body)
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        $bodyRaw = $this->bodyRaw($body);

        $response = $this->httpClient->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => $bodyRaw
        ]);

        $data = $response->getBody()->getContents();
        return json_decode($data, true);
    }

    public function putRequest($endpoint, array $body)
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        $bodyRaw = $this->bodyRaw($body);

        $response = $this->httpClient->put($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => $bodyRaw
        ]);

        $data = $response->getBody()->getContents();
        return json_decode($data, true);
    }

    public function patchRequest($endpoint, array $body)
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        // $bodyRaw = $this->bodyRaw($body);


        $response = $this->httpClient->patch($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json-patch+json'
            ],
            'json' => [
                [
                    "op" => "replace",
                    "path" => "/name",
                    "value" => $body['name']
                ],
                [
                    "op" => "replace",
                    "path" => "/partOf/reference",
                    "value" => "Organization/" . $body['part_of']
                ]
            ],
        ]);

        $data = $response->getBody()->getContents();
        return json_decode($data, true);
    }
}
