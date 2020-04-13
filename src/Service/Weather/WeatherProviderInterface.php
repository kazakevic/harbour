<?php

namespace App\Service\Weather;

use App\Model\Weather;

interface WeatherProviderInterface
{
    /**
     * @param float $lon
     * @param float $lat
     * @return mixed[]
     */
    public function getWeather(float $lon, float $lat): ?Weather;
}