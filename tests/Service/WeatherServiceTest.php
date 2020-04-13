<?php

namespace App\Tests\Service;

use App\Model\Weather;
use App\Service\Weather\WeatherProviderInterface;
use App\Service\Weather\WeatherService;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    /**
     * @return mixed
     */
    public function getWeatherTestData(): array
    {
        $out = [];

        $out[] = [
            'lon' => 1,
            'lat' => 2,
            'expectedWeather' => 2
        ];

        $out[] = [
            'lon' => 5,
            'lat' => 5,
            'expectedWeather' => 25
        ];

        // Weather api response failed
        $out[] = [
            'lon' => 9999,
            'lat' => 2,
            'expectedWeather' => null
        ];

        return $out;
    }

    /**
     * @dataProvider getWeatherTestData()
     * @param float $lon
     * @param float $lat
     * @param float $expectedWeather
     */
    public function testGetWeather(float $lon, float $lat, ?float $expectedWeather)
    {
        $service = new WeatherService();
        $service->addProvider('testsProvider', $this->getTestWeatherServiceProvider());

        $currentWeather = $service->getWeather($lon, $lat)->getAirTemperature();
        $this->assertEquals($expectedWeather, $currentWeather);
    }

    private function getTestWeatherServiceProvider(): WeatherProviderInterface
    {
        return new TestWeatherServiceProvider();
    }
}
