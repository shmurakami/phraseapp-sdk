<?php

namespace shmurakami\PhraseAppSDK\Entities;

class AbstractEntity
{
    /**
     * @var array
     */
    private $data = [];

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

}
