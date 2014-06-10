<?php

namespace bart\GooglePlaces;

use bart\GooglePlaces;
use bart\GooglePlaces\Exception\InvalidParameterException;

/**
 * NearbySearch
 */
final class NearbySearch implements Interfaces\QueryInterface
{
    use Traits\QueryParameters;

    /**
     * @param $assoc
     *
     * @return \stdClass|array
     */
    public function getQuery($assoc)
    {
        return json_decode('{}', $assoc);
    }

    /**
     * @param array $params
     * @throws Exception\InvalidParameterException
     */
    public function __construct(array $params)
    {
        // Setting parameters
        foreach ($params as $param => $value) {
            $method = 'set' . ucfirst(strtolower($param));
            if (!method_exists($this, $method)) {
                throw new InvalidParameterException(sprintf('Invalid parameter (%s)', $param));
            }

            $this->{$method}($value);
        }

    }
}
