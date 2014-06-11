<?php

namespace bart\GooglePlaces\Search;

/**
 * PlaceSearch
 */
abstract class PlaceSearch
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

}
