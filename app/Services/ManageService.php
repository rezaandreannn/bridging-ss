<?php

namespace App\Services;

abstract class ManageService
{
    protected $baseUrl;

    protected $authUrl;

    protected $clientId;

    protected $clientSecret;

    /**
     * abstract method getUrl
     */
    abstract public function setUrl();

    /**
     * abstract method getConsId
     */
    abstract public function setAuthUrl();

    /**
     * abstract method getSecretKey
     */
    abstract public function setClientId();

    /**
     * abstract method getUserKey
     */
    abstract public function setClientSecret();
}
