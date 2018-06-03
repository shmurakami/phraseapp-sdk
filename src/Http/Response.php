<?php

namespace shmurakami\PhraseAppSDK\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
    /**
     * @var GuzzleResponse
     */
    private $response;

    /**
     * Response constructor.
     */
    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

}
