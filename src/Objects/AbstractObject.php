<?php

namespace shmurakami\PhraseAppSDK\Objects;

use shmurakami\PhraseAppSDK\PhraseAppApi;

abstract class AbstractObject
{
    /**
     * @var array
     */
    private $data = [];
    /**
     * @var string project ID
     */
    protected $projectId;
    /**
     * @var string
     */
    protected $entityId;
    /**
     * @var PhraseAppApi
     */
    protected $api;

    /**
     * AbstractEntity constructor.
     */
    public function __construct($projectId, $entityId, PhraseAppApi $api)
    {
        $this->projectId = $projectId;
        $this->entityId = $entityId;
        $this->api = $api;
    }

    public function __get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return PhraseAppApi
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    abstract protected function buildUrl();

}
