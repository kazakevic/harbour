<?php

namespace App\Model;

class Weather
{
    /** @var float|null */
    private $airTemperature;

    /** @var string|null */
    private $weatherProvider;

    /** @var float */
    private $lon;

    /** @var float */
    private $lat;

    public function __construct(?float $airTemperature = null, ?string  $weatherProvider = null)
    {
        $this->airTemperature = $airTemperature;
        $this->weatherProvider = $weatherProvider;
    }

    public function getAirTemperature(): ?float
    {
        return $this->airTemperature;
    }

    public function setAirTemperature(?float $airTemperature): void
    {
        $this->airTemperature = $airTemperature;
    }

    public function getWeatherProvider(): ?string
    {
        return $this->weatherProvider;
    }

    public function setWeatherProvider(?string $weatherProvider): void
    {
        $this->weatherProvider = $weatherProvider;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function setLon(float $lon): void
    {
        $this->lon = $lon;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }
}
