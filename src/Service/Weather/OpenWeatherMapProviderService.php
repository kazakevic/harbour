<?php

namespace App\Service\Weather;

use GuzzleHttp\Client;

class OpenWeatherMapProviderService implements WeatherProviderInterface
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getWeather(float $lon, float $lat): array
    {
        $response = $this->client->get('/data/2.5/weather', [
            'query' => [
                'lon' => 1,
                'lat' => 1,
                'appid' => $this->apiKey
            ]
        ]);

        $data = $response->getBody()->getContents();
        //:TODO process data
    }
}
