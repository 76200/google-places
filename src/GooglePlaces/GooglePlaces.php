<?php

namespace bart\GooglePlaces;

use bart\GooglePlaces\Exception\APIKeyException;

/**
 * Class GooglePlaces
 */
class GooglePlaces
{
    const API_URL = 'https://maps.googleapis.com/maps/api/place';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * When true, returned objects will be converted into associative arrays.
     *
     * @var bool
     */
    private $assoc = false;

    /**
     * Constructor.
     *
     * @param string $apiKey
     *
     * @throws \InvalidArgumentException | APIKeyException
     */
    function __construct($apiKey)
    {
        if (!is_string($apiKey)) {
            throw new \InvalidArgumentException('Wrong API key format');
        }
        if (!isset($apiKey) || trim($apiKey) === '') {
            throw new APIKeyException('Empty API key');
        }
        $this->apiKey = $apiKey;
    }

    public function nearbySearch($location, $radius, $sensor, array $parameters = [])
    {
        $nearbySearch = new NearbySearch($parameters + [
            'location' => $location,
            'radius' => $radius,
            'sensor' => $sensor
          ]
        );

        return $nearbySearch->getQuery($this->assoc);
    }

    /**
     * @return boolean
     */
    public function isAssoc()
    {
        return $this->assoc === true;
    }

    /**
     * @param boolean $assoc
     *
     * @return $this
     */
    public function setAssoc($assoc)
    {
        $this->assoc = $assoc;

        return $this;
    }

}
