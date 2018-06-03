<?php

namespace shmurakami\PhraseAppSDK;

use shmurakami\PhraseAppSDK\Objects\Key;
use shmurakami\PhraseAppSDK\Objects\Locale;
use shmurakami\PhraseAppSDK\Objects\Project;
use shmurakami\PhraseAppSDK\Http\Request;

class PhraseAppApi
{
    /**
     * @var PhraseAppApi
     */
    private static $instance;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var string
     */
    private $accessToken;

    /**
     * PhraseAppAPI constructor.
     * @param string $accessToken
     */
    public function __construct($accessToken, $config = [])
    {
        $this->accessToken = $accessToken;
        $this->request = new Request($config);
    }

    public static function getInstance($accessToken)
    {
        if (self::$instance === null) {
            $instance = new self($accessToken);
            self::$instance = $instance;
        }
        return self::$instance;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $projectId
     * @return Project
     * @throws Exceptions\Http\RequestException
     */
    public function getProject($projectId)
    {
        $url = "projects/$projectId";
        $response = $this->getRequest()->get($url);
        return new Project($response);
    }

    /**
     * @param string $projectId
     * @param string $localeId
     * @return Locale
     * @throws Exceptions\Http\RequestException
     */
    public function getLocale($projectId, $localeId)
    {
        $url = "projects/$projectId/Locales/$localeId";
        $response = $this->getRequest()->get($url);
        return new Locale($response);
    }

    /**
     * @param string $projectId
     * @param string $keyId
     * @return Key
     * @throws Exceptions\Http\RequestException
     */
    public function getKey($projectId, $keyId)
    {
        $url = "projects/$projectId/keys/$keyId";
        $response = $this->getRequest()->get($url);
        return new Key($response);
    }


}
