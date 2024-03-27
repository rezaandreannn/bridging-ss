<?php

namespace App\Services\SatuSehat;

use DateTime;
use GuzzleHttp\Client;

class EncounterService
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

    protected function bodyPost(array $body)
    {
        $waktuWIB = date('Y-m-d\TH:i:sP', time());
        $dateTimeWIB = new DateTime($waktuWIB);
        $dateTimeWIB->modify("-7 hours");
        $waktuUTC = $dateTimeWIB->format('Y-m-d\TH:i:sP');

        $data = [
            "resourceType" => "Encounter",
            "status" => $body['status'],
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ],
            "subject" => [
                "reference" => "Patient/" . $body['patientId'],
                "display" => $body['patientName']
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/" . $body['practitionerIhs'],
                        "display" => $body['practitionerName']
                    ]
                ]
            ],
            "period" => [
                "start" => $waktuUTC
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/" . $body['locationId'],
                        "display" => $body['locationName']
                    ]
                ]
            ],
            "statusHistory" => [
                [
                    "status" => $body['statusHistory'],
                    "period" => [
                        "start" => $waktuUTC
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/" . $this->config->setOrganizationId()
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/" . $this->config->setOrganizationId(),
                    "value" => $body['kodeReg']
                ]
            ]
        ];

        return $data;
    }

    protected function bodyPatch(array $body)
    {
    }

    protected function processParams($param)
    {
    }

    public function getRequest($endpoint, $params = [])
    {
        $token = $this->accessToken->token();

        $url = $this->config->setUrl() . $endpoint;

        // $params = $this->processParams($params);

        // if (!empty($params['partOf'])) {
        //     $url .= '?' . http_build_query($params);
        // }

        // if (!empty($params['organization'])) {
        //     $url .= '?' . http_build_query($params);
        // }


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

        $bodyRaw = $this->bodyPost($body);

        $response = $this->httpClient->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => $bodyRaw
        ]);

        $data = $response->getBody()->getContents();
        return json_decode($data, true);
    }
}
