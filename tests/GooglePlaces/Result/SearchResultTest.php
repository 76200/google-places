<?php

use bart\GooglePlaces\Result\SearchResult;

/**
 * Class SearchResultTest
 */
class SearchResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SearchResult
     */
    private $searchResult;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $json = '{"results":[{"geometry":{"location":{"lat":53.4242111,"lng":14.5597306}}}],"status":"ok"}';
        $this->searchResult = new SearchResult($json);
    }

    /**
     * Testing if SearchResult::arrayResult returns an array
     */
    public function testArrayResult()
    {
        $result = $this->searchResult->arrayResult();

        $this->assertArrayHasKey('results', $result);
        $this->assertArrayHasKey('status', $result);
    }

    /**
     * Testing if SearchResult::objectResult returns stdClass
     */
    public function testObjectResult()
    {
        $result = $this->searchResult->objectResult();

        $this->assertObjectHasAttribute('results', $result);
        $this->assertObjectHasAttribute('status', $result);
    }

    /**
     * Testing if SearchResult::stringResult returns string
     */
    public function testStringResult()
    {
        $result = $this->searchResult->stringResult();

        $this->stringContains('location')->evaluate($result);
        $this->stringContains('"status":"ok"')->evaluate($result);
    }

    /**
     * Empty search result should not return next_page_token
     */
    public function testNextPageTokenShouldBeNull()
    {
        $result = $this->searchResult->getNextPageToken();

        $this->assertNull($result);
    }

    /**
     * SearchResult with $result should return string
     */
    public function testNextPageTokenShouldNotBeNull()
    {
        $fixture = $this->searchResult;
        $reflector = new ReflectionProperty(get_class($this->searchResult), 'result');
        $reflector->setAccessible(true);
        $reflector->setValue($fixture, '{"next_page_token":"yeah"}');

        $token = $fixture->getNextPageToken();

        $this->assertNotNull($token);
    }

    /**
     * Testing if SearchResult::__toString returns string
     */
    public function testToString()
    {
        $this->assertEquals($this->searchResult, $this->searchResult->stringResult());
    }

}
