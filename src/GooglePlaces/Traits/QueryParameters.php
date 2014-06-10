<?php

namespace bart\GooglePlaces\Traits;

/**
 * QueryParameters
 */
trait QueryParameters
{
    private $keyword;
    private $language;
    private $location;
    private $maxprice;
    private $minprice;
    private $name;
    private $opennow;
    private $pagetoken;
    private $radius;
    private $sensor;
    private $rankby;
    private $types;
    private $zagatselected;

    /**
     * @return mixed
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param mixed $keyword
     * @return $this
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxprice()
    {
        return $this->maxprice;
    }

    /**
     * @param mixed $maxprice
     * @return $this
     */
    public function setMaxprice($maxprice)
    {
        $this->maxprice = $maxprice;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinprice()
    {
        return $this->minprice;
    }

    /**
     * @param mixed $minprice
     * @return $this
     */
    public function setMinprice($minprice)
    {
        $this->minprice = $minprice;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpennow()
    {
        return $this->opennow;
    }

    /**
     * @param mixed $opennow
     * @return $this
     */
    public function setOpennow($opennow)
    {
        $this->opennow = $opennow;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagetoken()
    {
        return $this->pagetoken;
    }

    /**
     * @param mixed $pagetoken
     * @return $this
     */
    public function setPagetoken($pagetoken)
    {
        $this->pagetoken = $pagetoken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param mixed $radius
     * @return $this
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRankby()
    {
        return $this->rankby;
    }

    /**
     * @param mixed $rankby
     * @return $this
     */
    public function setRankby($rankby)
    {
        $this->rankby = $rankby;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * @param mixed $sensor
     * @return $this
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     * @return $this
     */
    public function setTypes($types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getZagatselected()
    {
        return $this->zagatselected;
    }

    /**
     * @param mixed $zagatselected
     * @return $this
     */
    public function setZagatselected($zagatselected)
    {
        $this->zagatselected = $zagatselected;

        return $this;
    }


}
