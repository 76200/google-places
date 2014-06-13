<?php

namespace bart\GooglePlaces\Search;

/**
 * Places
 */
abstract class Places
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
     * "textsearch" method partial URL
     */
    const TEXT_URL = 'textsearch';

}
