<?php

namespace App\Services\SatuSehat;

use GuzzleHttp\Client;
use App\Services\SatuSehat\ConfigSatuSehat;

class AccessToken
{
    protected $httpClient;
    protected $config;


    public function __construct()
    {
        $this->httpClient = new Client();
        $this->config = new ConfigSatuSehat();
    }

    public function token()
    {
        $response = $this->httpClient->post($this->config->setAuthUrl() . '/accesstoken', [
            'query' => [
                'grant_type' => 'client_credentials',
            ],
            'form_params' => [
                'client_id' => $this->config->setClientId(),
                'client_secret' => $this->config->setClientSecret(),
            ],
        ]);

        $data = $response->getBody()->getContents();
        $result = json_decode($data, true);
        return $result['access_token'];
    }
}
