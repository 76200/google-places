<?php

namespace bart\GooglePlaces\Search;
use bart\GooglePlaces\Interfaces\SearchInterface;

/**
 * PlaceSearch
 */
abstract class PlaceSearch extends Places implements SearchInterface
{
    /**
     * The maximum allowed radius is 50 000 meters
     */
    const MAXIMUM_RADIUS = 50000;

    /**
     * Price level - free
     */
    const PRICE_FREE = 0;

    /**
     * Price level - inexpensive
     */
    const PRICE_INEXPENSIVE = 1;

    /**
     * Price level - moderate
     */
    const PRICE_MODERATE = 2;

    /**
     * Price level - expensive
     */
    const PRICE_EXPENSIVE = 3;

    /**
     * Price level - very expensive
     */
    const PRICE_VERY_EXPENSIVE = 4;

    /**
     * @var array Query parameters
     */
    protected $parameters;

    /**
     * @param array $parameters
     */
    function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
