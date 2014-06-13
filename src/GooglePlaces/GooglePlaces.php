<?php

namespace bart\GooglePlaces;

use bart\GooglePlaces\Exception\APIKeyException;
use bart\GooglePlaces\Result\SearchResult;
use bart\GooglePlaces\Search;

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
     * @var string Next page token
     */
    private $nextPageToken = null;

    /**
     * Constructor.
     *
     * @param string $apiKey
     *
     * @throws \InvalidArgumentException|APIKeyException
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
     * Executes Nearby Search
     *
     * @param array $location   Latitude and Longitude
     * @param int   $radius     Radius in meters
     * @param bool  $sensor     Indicates whether or not the Place request came from a device using a location sensor
     * @param array $parameters Optional parameters
     *
     * @return SearchResult
     */
    public function nearbySearch(array $location, $radius, $sensor, array $parameters = [])
    {
        $search = new Search\NearbySearch($parameters + [
                'location' => $location,
                'radius' => $radius,
                'sensor' => $sensor,
                'key' => $this->apiKey
            ]
        );
        $result = $search->execute();
        $this->nextPageToken = $result->getNextPageToken();

        return $result;
    }

    /**
     * Executes Text Search
     *
     * @param string $query      The text string on which to search
     * @param bool   $sensor     Indicates whether or not the Place request came from a device using a location sensor
     * @param array  $parameters Optional parameters
     *
     * @return SearchResult
     */
    public function textSearch($query, $sensor = false, array $parameters = [])
    {
        $search = new Search\TextSearch($parameters + [
            'query' => $query,
            'sensor' => $sensor,
            'key' => $this->apiKey
          ]
        );
        $result = $search->execute();
        $this->nextPageToken = $result->getNextPageToken();

        return $result;
    }

    /**
     * @return SearchResult
     */
    public function next()
    {
        $search = new Search\NextPage([
            'pagetoken' => $this->nextPageToken,
            'key' => $this->apiKey
        ]);
        $result = $search->execute();
        $this->nextPageToken = $result->getNextPageToken();

        return $result;
    }

}
