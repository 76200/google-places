<?php

namespace bart\GooglePlaces\Converter;

use bart\GooglePlaces\Exception\InvalidParameterException;
use bart\GooglePlaces\Interfaces\ParamConverterInterface;

/**
 * NearbySearchConverter
 */
class NearbySearchConverter implements ParamConverterInterface
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
        } else {
            if (!isset($this->params['location'])) {
                throw new InvalidParameterException('Empty "location" parameter');
            }
            if (!is_array($this->params['location'])) {
                throw new InvalidParameterException('Location should be an array with "latitude" and "longitude" keys');
            }

        }

        return $this;
    }

    /**
     * Converts "rankby" parameter
     *
     * @throws InvalidParameterException
     * @return $this
     */
    private function convertRankBy()
    {
        //If rankby == 'distance'
        if (isset($this->params['rankby']) && $this->params['rankby'] == 'distance') {
            // Radius must not be set
            unset($this->params['radius']);
            // One of the parameters must be set
            if (!(isset($this->params['keyword']) || isset($this->params['name']) || isset($this->params['types']))) {
                throw new InvalidParameterException('One of the parameters ("keyword", "name" or "types") must be set.');
            }
        }

        return $this;
    }

    /**
     * Converts "zagatselected" and makes sure it doesn't contain any value
     *
     * @return $this
     */
    private function convertZagatselected()
    {
        if (isset($this->params['zagatselected'])) {
            if ($this->params['zagatselected'] != null) {
                // todo this need to be solved in other way. Expected result: http://example.com?a=b&zagatselected&c=d
                $this->params['zagatselected'] = '';
            }
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
          ->convertRankBy()
          ->convertZagatselected()
          ->params;
    }

}
