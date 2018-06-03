<?php

namespace shmurakami\PhraseAppSDK\Objects;

/**
 * @property-read string id
 * @property-read string name
 * @property-read string code
 * @property-read bool default
 * @property-read bool main
 * @property-read bool rtl
 * @property-read string[] plural_forms
 * @property-read array source_locale
 * @property-read string created_at
 * @property-read string updated_at
 */
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
