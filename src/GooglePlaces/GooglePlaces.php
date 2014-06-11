<?php

namespace bart\GooglePlaces;

use bart\GooglePlaces\Converter\NearbySearchConverter;
use bart\GooglePlaces\Exception\APIKeyException;
use bart\GooglePlaces\Result\SearchResult;

/**
 * Class GooglePlaces
 */
class GooglePlaces
{
    /**
     * Base GooglePlacesAPI URL
     */
    const API_URL = 'https://maps.googleapis.com/maps/api/place';

    /**
     * "nearbysearch" method partial URL
     */
    const NEARBY_URL = 'nearbysearch';

    /**
     * @var string
     */
    private $apiKey;

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

    /**
     * @param array $location   Latitude and Longitude
     * @param int $radius       Radius in meters
     * @param bool $sensor      Indicates whether or not the Place request came from a device using a location sensor
     * @param array $parameters Optional parameters
     *
     * @return SearchResult
     */
    public function nearbySearch(array $location, $radius, $sensor, array $parameters = [])
    {
        $converter = new NearbySearchConverter($parameters + [
            'location' => $location,
            'radius' => $radius,
            'sensor' => $sensor,
            'key' => $this->apiKey
          ]
        );

        $params = $converter->convert();

        $query = sprintf('%s/%s/json?%s', self::API_URL, self::NEARBY_URL, rawurldecode(http_build_query($params)));
        $response = file_get_contents($query);

        return new SearchResult($response);
    }

}
