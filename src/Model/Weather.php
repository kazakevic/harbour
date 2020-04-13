<?php

namespace App\Model;

class Weather
{
    /** @var float */
    private $airTemperature;

    /** @var string */
    private $weatherProvider;

    /** @var float */
    private $lon;

    /** @var float */
    private $lat;

    /**
     * @return float
     */
    public function getAirTemperature(): float
    {
        return $this->airTemperature;
    }

    /**
     * @param float $airTemperature
     */
    public function setAirTemperature(float $airTemperature): void
    {
        $this->airTemperature = $airTemperature;
    }

    /**
     * @return string
     */
    public function getWeatherProvider(): string
    {
        return $this->weatherProvider;
    }

    /**
     * @param string $weatherProvider
     */
    public function setWeatherProvider(string $weatherProvider): void
    {
        $this->weatherProvider = $weatherProvider;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     */
    public function setLon(float $lon): void
    {
        $this->lon = $lon;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }
}
