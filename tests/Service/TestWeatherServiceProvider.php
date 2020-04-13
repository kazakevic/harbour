<?php

namespace App\Tests\Service;

use App\Model\Weather;
use App\Service\Weather\WeatherProviderInterface;

class TestWeatherServiceProvider implements WeatherProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getWeather(float $lon, float $lat): ?Weather
    {
        //case when API bring wrong response
        if ($lon == 9999) {
            return null;
        }
        $weather = new Weather();
        $temperature = (float) $lon * $lat;
        $weather->setAirTemperature($temperature);
        $weather->setWeatherProvider('TW');

        return $weather;
    }
}
