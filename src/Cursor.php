<?php

namespace shmurakami\PhraseAppSDK;

use ArrayAccess;
use Iterator;
use shmurakami\PhraseAppSDK\Http\Response;
use shmurakami\PhraseAppSDK\Http\ResponseInterface;
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
    /**
     * @var int fetched object count
     */
    private $itemCount = 0;
    /**
     * @var int request page parameter
     */
    private $page = 1;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var AbstractObject
     */
    private $prototypeObject;

    public function __construct(Response $response, AbstractObject $prototypeObject)
    {
        $this->response = $response;
        $this->prototypeObject = $prototypeObject;

        $this->setObjectFromResponse($response);
    }

    private function setObjectFromResponse(ResponseInterface $response)
    {
        $contents = $response->getContents();
        foreach ($contents as $content) {
            $object = clone $this->prototypeObject;
            $object->setData($content);
            $this->objects[] = $object;
        }
        $this->itemCount = count($this->objects);
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
        $this->position++;
        if ($this->itemCount == $this->position) {
            $response = $this->requestNextPage();
            $this->setObjectFromResponse($response);
        }
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

    /**
     * @return ResponseInterface
     * @throws Exceptions\Http\RequestException
     */
    private function requestNextPage()
    {
        $page = ++$this->page;
        // todo how to get last url? where is good to keep url?
        $nextPageUrl = '';
        // todo need to keep additional header
        return $this->response->getRequest()->get($nextPageUrl);
    }
}
