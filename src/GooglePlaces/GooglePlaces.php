<?php

namespace bart\GooglePlaces;

use bart\GooglePlaces\Exception\APIKeyException;

/**
 * Class GooglePlaces
 */
class GooglePlaces
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * Constructor.
     *
     * @param string $apiKey
     * @throws \InvalidArgumentException | APIKeyException
     */
    function __construct($apiKey)
    {
        if(!is_string($apiKey)) {
            throw new \InvalidArgumentException('Wrong API key format');
        }
        if (!trim($apiKey) || !is_string($apiKey)) {
            throw new APIKeyException('Empty API key');
        }

        $this->apiKey = $apiKey;
    }

}
