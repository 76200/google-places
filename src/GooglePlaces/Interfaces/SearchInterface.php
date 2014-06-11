<?php

namespace bart\GooglePlaces\Interfaces;

use bart\GooglePlaces\Result\SearchResult;

/**
 * Interface SearchInterface
 */
interface SearchInterface
{
    /**
     * Executes search
     *
     * @return SearchResult
     */
    public function execute();
}
