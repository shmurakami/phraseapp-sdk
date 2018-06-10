<?php

namespace shmurakami\PhraseAppSDK\Objects;

use shmurakami\PhraseAppSDK\Cursor;
use shmurakami\PhraseAppSDK\Exceptions\Http\RequestException;
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
     * @param string $projectId
     * @param string $entityId
     * @param PhraseAppApi $api
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
     * @param string $className
     * @param string $parentId
     * @param string"null $instanceId
     * @return Cursor
     * @throws RequestException
     */
    protected function getRelatedObjects($className, $parentId, $instanceId = null)
    {
        /** @var AbstractObject $baseKey */
        $baseKey = new $className($parentId, $instanceId, $this->getApi());
        $url = $baseKey->buildUrl();
        $responses = $this->getApi()->getRequest()->get($url);
        $objects = [];
        foreach ($responses as $response) {
            $id = $response['id'];
            /** @var AbstractObject $object */
            $object = new $className($parentId, $id, $this->getApi());
            $object->setData($response);
            $objects[] = $object;
        }
        return new Cursor($objects);
    }

    /**
     * @return string
     */
    abstract protected function buildUrl();

}
