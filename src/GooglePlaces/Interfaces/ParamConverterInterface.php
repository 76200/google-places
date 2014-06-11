<?php

namespace bart\GooglePlaces\Interfaces;

/**
 * Interface ParamConverterInterface
 */
interface ParamConverterInterface
{
    /**
     * Constructor.
     *
     * @param array $params
     */
    public function __construct(array $params);

    /**
     * Converts parameters
     *
     * @return array
     */
    public function convert();
}
