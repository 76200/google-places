<?php

namespace bart\GooglePlaces\Search;

use bart\GooglePlaces\Converter\TextSearchConverter;
use bart\GooglePlaces\Result\SearchResult;

/**
 * TextSearch
 */
class TextSearch extends PlaceSearch
{
    /**
     * Executes Test Search
     *
     * @return SearchResult
     */
    public function execute()
    {
        $converter = new TextSearchConverter($this->parameters);
        $params = $converter->convert();
        $query = sprintf('%s/%s/json?%s', self::API_URL, self::TEXT_URL, rawurldecode(http_build_query($params)));
        $response = file_get_contents($query);

        return new SearchResult($response);
    }

}
