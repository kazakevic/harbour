<?php

namespace App\Service\Weather;

class WeatherService
{
    /** @var WeatherProviderInterface[] */
    private $weatherProviders = [];

    public function addProvider(string $name, WeatherProviderInterface $service)
    {
        $this->weatherProviders[$name] = $service;
    }

    public function getWeather(float $lon, float $lat)
    {
        foreach ($this->weatherProviders as $provider) {
            if ($provider->getWeather($lon, $lat)) {
                return $provider->getWeather($lon, $lat);
            }
        }
    }
}
