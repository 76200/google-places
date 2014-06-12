<?php

use bart\GooglePlaces\Converter\NearbySearchConverter;
use bart\GooglePlaces\Exception;

/**
 * Class NearbySearchConverterTest
 */
class NearbySearchConverterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException bart\GooglePlaces\Exception\InvalidParameterException
     */
    public function testEmptyLocationParameter()
    {
        (new NearbySearchConverter(['location']))->convert();
    }

    /**
     * @expectedException bart\GooglePlaces\Exception\InvalidParameterException
     * @expectedExceptionMessage  Missing parameter: "Latitude"
     */
    public function testMissingLatitude()
    {
        (new NearbySearchConverter(['location' =>[]]))->convert();
    }

    /**
     * @expectedException bart\GooglePlaces\Exception\InvalidParameterException
     * @expectedExceptionMessage  Missing parameter: "Longitude"
     */
    public function testMissingLongitude()
    {
        (new NearbySearchConverter(['location' =>['latitude']]))->convert();
    }

    public function testLocation()
    {
        // Location passed as an array with named keys with int values
        $params1 = (new NearbySearchConverter(['location' => ['latitude' => 1, 'longitude' => 2]]))->convert();
        $this->assertEquals($params1['location'], '1,2');

        // Location passed as an array with named keys with int values ( inverted keys order )
        $params2 = (new NearbySearchConverter(['location' => ['longitude' => 3, 'latitude' => 4]]))->convert();
        $this->assertEquals($params2['location'], '4,3');

        // Location passed as an array with default keys with int values
        $params3 = (new NearbySearchConverter(['location' => [5, 6]]))->convert();
        $this->assertEquals($params3['location'], '5,6');

        // Location passed as an array with named keys with float values
        $params4 = (new NearbySearchConverter(['location' => ['latitude' => 3.14, 'longitude' => 4.999999]]))->convert();
        $this->assertEquals($params4['location'], '3.14,4.999999');

        // Location passed as an array with default keys with float values
        $params4 = (new NearbySearchConverter(['location' => [54.464678, 17.017612]]))->convert();
        $this->assertEquals($params4['location'], '54.464678,17.017612');

        $this->setExpectedException('bart\GooglePlaces\Exception\InvalidParameterException',
          'Location should be an array with "latitude" and "longitude" keys');
        (new NearbySearchConverter(['location' => '12,34']))->convert();

    }

    public function testRankBy()
    {
        $params1 = (new NearbySearchConverter([
            'location' => [1,2],
            'rankby' => 'distance',
            'radius' => 600,
            'keyword' =>1
          ])
        )->convert();

        $this->assertArrayNotHasKey('radius', $params1);
    }

    /**
     * @expectedException bart\GooglePlaces\Exception\InvalidParameterException
     * @expectedExceptionMessage  One of the parameters ("keyword", "name" or "types") must be set.
     */
    public function testMissingKeywordNameType()
    {
        (new NearbySearchConverter(['location' => [1,2], 'rankby' => 'distance']))->convert();
    }

    public function testKeywordNameType()
    {
        $params1 = (new NearbySearchConverter([
          'location' => [1, 2],
          'rankby' => 'distance',
          'keyword' => 'pass',
          'name' => 'some_name',
          'type' => 'some_type'
        ]))->convert();

        $this->assertArrayNotHasKey('radius', $params1);
        $this->assertEquals($params1['keyword'], 'pass');
        $this->assertEquals($params1['name'], 'some_name');
        $this->assertEquals($params1['type'], 'some_type');
    }

    /**
     * Testing convert method
     */
    public function testConvert()
    {
        $initial1 = [
            'location' => [1,2],
            'radius' => 60,
            'rankby' => 'distance',
            'sensor' => true,
            'keyword' => 'k',
            'name' => 'n',
            'type' => 't'
        ];

        $converted1 = (new NearbySearchConverter($initial1))->convert();

        $this->assertArrayNotHasKey('radius', $converted1);
        $this->assertEquals($converted1['location'], '1,2');

        $initial2 = [
          'location' => ['longitude'=>4.56, 3],
          'radius' => 696,
          'rankby' => 'prominence',
          'sensor' => true,
          'keyword' => 'ke',
          'name' => 'na',
          'type' => 'ty'
        ];

        $converted2 = (new NearbySearchConverter($initial2))->convert();

        $this->assertEquals($converted2['radius'], $initial2['radius']);
        $this->assertEquals($converted2['location'], '3,4.56');
    }

}
