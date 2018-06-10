<?php

namespace shmurakami\PhraseAppSDK;

use ArrayAccess;
use Iterator;
use shmurakami\PhraseAppSDK\Objects\AbstractObject;

/**
 * TODO support paging
 */
class Cursor implements ArrayAccess, Iterator
{
    /**
     * @var AbstractObject[]
     */
    private $objects = [];
    /**
     * @var int iterator current position
     */
    private $position = 0;

    public function __construct(array $objects)
    {
        $this->objects = $objects;
    }

    public function offsetExists($offset)
    {
        return isset($this->objects[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->objects[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->objects[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->objects[$offset]);
    }

    public function current()
    {
        $position = $this->position;
        if ($this->offsetExists($position)) {
            return $this->offsetGet($position);
        }
        return null;
    }

    public function next()
    {
        if (count($this->objects) >= $this->position) {
            // TODO get next
            $objects = [];
            foreach ($objects as $object) {
                $this->objects[] = $object;
            }
            // TODO cursor needs response
        }

        $this->position++;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return $this->offsetExists($this->position);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
