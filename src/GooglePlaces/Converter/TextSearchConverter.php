<?php

namespace bart\GooglePlaces\Converter;

use bart\GooglePlaces\Exception\InvalidParameterException;
use bart\GooglePlaces\Interfaces\ParamConverterInterface;

/**
 * TextSearchConverter
 */
class TextSearchConverter implements ParamConverterInterface
{
    /**
     * @var array Parameters
     */
    private $params;

    /**
     * Constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Converts location array into `latitude` and `longitude` parameter
     *
     * @throws InvalidParameterException
     * @return $this
     */
    private function convertLocation()
    {
        if (isset($this->params['location']) && is_array($this->params['location'])) {
            // Flattening "location" array into "latitude" and "longitude"
            $location = [];
            // "location" array can contain "latitude"/"longitude" keys or default 0/1
            if (isset($this->params['location']['latitude'])) {
                $location[]  = $this->params['location']['latitude'];
            } else {
                if (isset($this->params['location'][0])) {
                    $location[] = $this->params['location'][0];
                } else {
                    throw new InvalidParameterException('Missing parameter: "Latitude"');
                }
            }
            if (isset($this->params['location']['longitude'])) {
                $location[] = $this->params['location']['longitude'];
            } else {
                if (isset($this->params['location'][1])) {
                    $location[] = $this->params['location'][1];
                } else {
                    throw new InvalidParameterException('Missing parameter: "Longitude"');
                }
            }
            $this->params['location'] = implode(',', $location);
        }

        return $this;
    }

    /**
     * Converts radius
     *
     * @throws InvalidParameterException
     * @return $this
     */
    private function convertRadius()
    {
        if (isset($this->params['location']) && !(isset($this->params['radius']))) {
            throw new InvalidParameterException('Missing "radius" parameter');
        }

        return $this;
    }

    /**
     * Converts parameters
     *
     * @throws InvalidParameterException
     * @return array
     */
    public function convert()
    {
        return $this
          ->convertLocation()
          ->convertRadius()
          ->params;
    }

}
