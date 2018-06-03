<?php

namespace shmurakami\PhraseAppSDK\Objects;

/**
 * @property-read string id
 * @property-read string name
 * @property-read string description
 * @property-read string name_hash
 * @property-read bool plural
 * @property-read string[] tags
 * @property-read string data_type
 * @property-read string created_at
 * @property-read string updated_at
 */
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
