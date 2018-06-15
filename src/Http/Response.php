<?php

namespace shmurakami\PhraseAppSDK\Http;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var PsrResponseInterface
     */
    private $response;

    /**
     * Response constructor.
     */
    public function __construct(Request $request, PsrResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return PsrResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->getResponse()->getStatusCode();
    }

    /**
     * @param bool $toArray
     * @return array
     */
    public function getContents($toArray = true)
    {
        return json_decode($this->getResponse()->getBody()->getContents(), $toArray);
    }

}
