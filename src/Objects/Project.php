<?php

namespace shmurakami\PhraseAppSDK\Objects;

use shmurakami\PhraseAppSDK\Cursor;
use shmurakami\PhraseAppSDK\Exceptions\Http\RequestException;
use shmurakami\PhraseAppSDK\PhraseAppApi;

class Project extends AbstractObject
{
    /**
     * @noinspection PhpMissingParentConstructorInspection
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
        $baseLocale = new Locale($this->projectId, null, $this->getApi());
        $url = $baseLocale->buildUrl();
        $responses = $this->getApi()->getRequest()->get($url);
        $locales = [];
        foreach ($responses as $response) {
            $id = $response['id'];
            $locale = new Locale($this->projectId, $id, $this->getApi());
            $locale->setData($response);
            $locales[] = $locale;
        }
        return new Cursor($locales);
    }

    /**
     * @return Cursor|Key[]
     * @throws RequestException
     * TODO extract as getChilds with instance Arg
     */
    public function getKeys()
    {
        $baseKey = new Key($this->projectId, null, $this->getApi());
        $url = $baseKey->buildUrl();
        $responses = $this->getApi()->getRequest()->get($url);
        $keys = [];
        foreach ($responses as $response) {
            $id = $response['id'];
            $key = new Key($this->projectId, $id, $this->getApi());
            $key->setData($response);
            $keys[] = $key;
        }
        return new Cursor($keys);
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
