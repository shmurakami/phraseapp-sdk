<?php

namespace shmurakami\PhraseAppSDK;

use shmurakami\PhraseAppSDK\Exceptions\LogicException;
use shmurakami\PhraseAppSDK\Http\Request;

class PhraseAppApi
{
    /**
     * @var PhraseAppApi
     */
    private static $instance;
    /**
     * @var Request
     */
    private $request;

    /**
     * PhraseAppAPI constructor.
     * @param string $accessToken
     * @param array $config
     */
    public function __construct($accessToken, $config = [])
    {
        $this->request = new Request($accessToken, $config);
    }

    /**
     * @param $accessToken
     * @param array $config
     * @return PhraseAppApi
     */
    public static function init($accessToken, $config = [])
    {
        if (self::$instance === null) {
            $instance = new self($accessToken, $config);
            self::setInstance($instance);
        }
        return self::$instance;
    }

    /**
     * @return PhraseAppApi
     * @throws LogicException
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            throw new LogicException('You must call ::init method first');
        }
        return self::$instance;
    }

    /**
     * @param PhraseAppApi $instance
     */
    public static function setInstance(PhraseAppApi $instance)
    {
        self::$instance = $instance;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
