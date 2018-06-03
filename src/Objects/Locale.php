<?php

namespace shmurakami\PhraseAppSDK\Objects;

class Locale extends AbstractObject
{
    /**
     * @return string
     */
    protected function buildUrl()
    {
        $url = "projects/{$this->projectId}/locales";
        if ($this->entityId) {
            $url .= "/{$this->entityId}";
        }
        return $url;
    }
}
