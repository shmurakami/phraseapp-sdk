<?php

namespace shmurakami\PhraseAppSDK\Objects;

class Key extends AbstractObject
{
    /**
     * @return string
     */
    protected function buildUrl()
    {
        $url = "projects/{$this->projectId}/keys";
        if ($this->entityId) {
            $url .= "/{$this->entityId}";
        }
        return $url;
    }
}
