<?php

namespace shmurakami\PhraseAppSDK\Http;

use GuzzleHttp\Client;
use shmurakami\PhraseAppSDK\Exceptions\Http\RequestException;

class Request implements RequestInterface
{
    const BASE_URL = 'https://api.phraseapp.com/api/v2/';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $accedssToken = '';

    /**
     * @param string $accessToken
     * @param array $config
     */
    public function __construct($accessToken, $config = [])
    {
        $this->accedssToken = $accessToken;
        $this->client = new Client($this->defaultOption($config));
    }

    private function defaultOption($config)
    {
        if (!isset($config['base_uri'])) {
            $config['base_uri'] = self::BASE_URL;
        }
        return $config;
    }

    /**
     * @param $url
     * @param array $header
     * @return Response
     * @throws RequestException
     */
    public function get($url, $header = [])
    {
        $response = $this->client->get($url, [
            'headers' => $this->getHeader($header),
        ]);
        if ($response->getStatusCode() !== 200) {
            throw new RequestException('failed http get request', $response->getStatusCode());
        }
        return new Response($this, $response);
    }

    /**
     * @param $url
     * @param null $body
     * @param array $header
     * @return array
     * @throws RequestException
     */
    public function post($url, $body = null, $header = [])
    {
        $response = $this->client->post($url, [
            'body'    => $body,
            'headers' => $this->getHeader($header),
        ]);
        if ($response->getStatusCode() !== 201) {
            throw new RequestException('failed http post request', $response->getStatusCode());
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $header
     * @return array
     */
    private function getHeader($header = [])
    {
        return array_merge($header, [
            'Authorization' => 'token ' . $this->accedssToken,
        ]);
    }

}
