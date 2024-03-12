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
                    "system" => "http://sys-ids.kemkes.go.id/location/" . $this->config->setOrganizationId(),
                    "value" => $body['identifier_value']
                ]
            ],
            "status" => $body['status'],
            "name" => $body['name'],
            "description" => $body['description'],
            "mode" => $body['mode'],
            "physicalType" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
                            "code" => $body['coding_code'],
                            "display" => $body['coding_display']
                        ]
                    ]
                ]
            ],
            "managingOrganization" => [
                "reference" => "Organization/" . $body['organization_id']
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
                "reference" => "Location/" . $body['part_of']
            ];
        }
        // Gabungkan array tambahan ke dalam array utama
        $data = array_merge($data, $additionalData);

        return $data;
    }

    protected function processParams($params)
    {
        if (isset($params['id'])) {
            $params['id'] = $params['id'];
        }

        if (isset($params['organization'])) {
            $params['organization'] = $params['organization'];
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

        if (!empty($params['organization'])) {
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
