<?php

namespace bart\GooglePlaces\Search;

use bart\GooglePlaces\Result\SearchResult;

/**
 * NextPage
 */
class NextPage extends PlaceSearch
{
    /**
     * Executes Next Search
     *
     * @throws \Exception
     * @return SearchResult
     */
    public function execute()
    {
        if(!isset($this->parameters['pagetoken'])) {
            throw new \Exception('Next page token is not set');
        }
        $query = sprintf('%s/%s/json?%s', self::API_URL, self::NEARBY_URL, rawurldecode(http_build_query($this->parameters)));

        /*
         * According to the documentation (https://developers.google.com/places/documentation/search)
         *
         *     There is a short delay between when a next_page_token is issued, and when it will become valid.
         *     Requesting the next page before it is available will return an INVALID_REQUEST response.
         *     Retrying the request with the same next_page_token will return the next page of results.
         *
         * Executing "sleep(2);" ensures that the query will return valid result.
         * Looks crazy, but I don't have any other solution for that.
         */
        sleep(2);
        $response = file_get_contents($query);

        return new SearchResult($response);
    }

}
