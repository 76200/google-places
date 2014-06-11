<?php

use bart\GooglePlaces\GooglePlaces;

/**
 * Class GooglePlacesTest
 */
class GooglePlacesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException bart\GooglePlaces\Exception\APIKeyException
     */
    public function testEmptyConstructor()
    {
        new GooglePlaces('');
    }

    /**
     * @expectedException bart\GooglePlaces\Exception\APIKeyException
     */
    public function testEmptyConstructorWhitespaces()
    {
        new GooglePlaces(' ');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidArgument1()
    {
        new GooglePlaces([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidArgument2()
    {
        new GooglePlaces(2);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidArgument3()
    {
        new GooglePlaces(null);
    }

}
