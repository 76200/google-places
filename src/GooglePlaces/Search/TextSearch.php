<?php

namespace bart\GooglePlaces\Search;

use bart\GooglePlaces\Converter\NearbySearchConverter;
use bart\GooglePlaces\Result\SearchResult;

/**
 * TextSearch
 */
class TextSearch extends PlaceSearch
{
    /**
     * @return SearchResult
     */
    public function execute()
    {
        $converter = new NearbySearchConverter($this->parameters);
        $params = $converter->convert();
        $query = sprintf('%s/%s/json?%s', self::API_URL, self::NEARBY_URL, rawurldecode(http_build_query($params)));
        $response = file_get_contents($query);

        return new SearchResult($response);
    }

}
