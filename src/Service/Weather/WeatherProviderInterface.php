<?php

namespace App\Service\Weather;

interface WeatherProviderInterface
{
    /**
     * @param float $lon
     * @param float $lat
     * @return mixed[]
     */
    public function getWeather(float $lon, float $lat): array;
}