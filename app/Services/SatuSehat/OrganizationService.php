<?php

namespace App\Services\SatuSehat;

use GuzzleHttp\Client;

class OrganizationService
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
            "resourceType" => "Organization",
            "active" => true,
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "http://sys-ids.kemkes.go.id/organization/" . $this->config->setOrganizationId(),
                    "value" => $body['name']
                ]
            ],
            "type" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
                            "code" => "dept",
                            "display" => "Hospital Department"
                        ]
                    ]
                ]
            ],
            "name" => $body['name'],
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
            "partOf" => [
                "reference" => "Organization/" . $body['part_of']
            ]
        ];

        $additionalData = [];

        // Tambahkan elemen "id" berdasarkan kondisi ke dalam array tambahan
        if ($body['id']) {
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
        $data["active"] = true;

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
            $params['partOf'] = $params['partOf'];
        }

        return $params;
    }

    public function getRequest($endpoint, $params = [])
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        $params = $this->processParams($params);

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
}
