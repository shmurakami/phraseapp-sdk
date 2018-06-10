<?php

namespace shmurakami\PhraseAppSDK\Objects;

use shmurakami\PhraseAppSDK\Cursor;
use shmurakami\PhraseAppSDK\Exceptions\Http\RequestException;
use shmurakami\PhraseAppSDK\PhraseAppApi;

/**
 * @property-read string id
 * @property-read string name
 * @property-read string main_format
 * @property-read string project_image_url
 * @property-read string account
 * @property-read string created_at
 * @property-read string updated_at
 */
class Project extends AbstractObject
{
    /**
     * @noinspection PhpMissingParentConstructorInspection
     * @param $projectId
     * @param PhraseAppApi $api
     */
    public function __construct($projectId, PhraseAppApi $api)
    {
        $this->projectId = $projectId;
        $this->entityId = null;
        $this->api = $api;
    }

    /**
     * @return Cursor|Locale[]
     * @throws RequestException
     */
    public function getLocales()
    {
        return $this->getRelatedObjects(Locale::class, $this->projectId);
    }

    /**
     * @return Cursor|Key[]
     * @throws RequestException
     */
    public function getKeys()
    {
        return $this->getRelatedObjects(Key::class, $this->projectId);
    }

    /**
     * @param string $entityId
     * @return string
     */
    protected function buildUrl($entityId = null)
    {
        return "projects/{$this->projectId}";
    }
}
