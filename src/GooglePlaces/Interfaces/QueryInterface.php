<?php

namespace bart\GooglePlaces\Interfaces;

/**
 * Interface QueryInterface
 */
interface QueryInterface
{
    /**
     * Gets query
     *
     * @param $assoc
     *
     * @return mixed
     */
    public function getQuery($assoc);

    /**
     * @param array $params
     */
    public function __construct(array $params);
}
