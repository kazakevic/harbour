<?php

namespace App\Service\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class StormGlassProviderService implements WeatherProviderInterface
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.stormglass.io',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getWeather(float $lon, float $lat): array
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));

        $headers = [
            'Authorization' => $this->apiKey
        ];

        $response = $this->client->get('/v2/weather/point', [
            'query' => [
                'lng' => 1,
                'lat' => 1,
                'params' => 'airTemperature',
                'start' => $dateTime->format('Y-m-d H:i:s'),
                'end' => $dateTime->format('Y-m-d H:i:s'),
            ],
            'headers' => $headers
        ]);

        $data = $response->getBody()->getContents();
        //:TODO process response
    }
}
