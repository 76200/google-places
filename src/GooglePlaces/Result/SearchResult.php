<?php

namespace bart\GooglePlaces\Result;

/**
 * SearchResult
 *
 * Allows returning JSON result as array, stdObject or string
 */
class SearchResult
{
    /**
     * @var string
     */
    private $result;

    /**
     * @param string $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->stringResult();
    }

    /**
     * Returns next_page_token
     *
     * @return null|string
     */
    public function getNextPageToken()
    {
        $result = $this->arrayResult();

        return isset($result['next_page_token']) ? $result['next_page_token'] : null;
    }

    /**
     * @return array
     */
    public function arrayResult()
    {
        return json_decode($this->result, true);
    }

    /**
     * @return \stdClass
     */
    public function objectResult()
    {
        return json_decode($this->result);
    }

    /**
     * @return string
     */
    public function stringResult()
    {
        return $this->result;
    }

}
