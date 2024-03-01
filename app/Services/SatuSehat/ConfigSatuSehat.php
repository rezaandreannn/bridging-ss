<?php

namespace App\Services\SatuSehat;

use App\Services\ManageService;
use Dotenv\Dotenv;


class ConfigSatuSehat extends ManageService
{

    protected $baseUrl;
    protected $authUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $dotenv = Dotenv::createUnsafeImmutable(getcwd());
        $dotenv->safeLoad();
        $this->baseUrl = env('SATU_SEHAT_BASE_URL');
        $this->authUrl = env('SATU_SEHAT_AUTH_URL');
        $this->clientId = env('SATU_SEHAT_CLIENT_ID');
        $this->clientSecret = env('SATU_SEHAT_CLIENT_SECRET');
    }

    public function setUrl()
    {
        return $this->baseUrl;
    }

    public function setAuthUrl()
    {
        return $this->authUrl;
    }

    public function setClientId()
    {
        return $this->clientId;
    }

    public function setClientSecret()
    {
        return $this->clientSecret;
    }
}
