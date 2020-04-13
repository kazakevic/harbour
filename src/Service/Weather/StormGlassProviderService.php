<?php

namespace App\Service\Weather;

use App\Model\Weather;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class StormGlassProviderService implements WeatherProviderInterface
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    /** @var LoggerInterface */
    private $logger;

    /** @var string */
    private const PROVIDER_NAME = 'StormGlass';

    public function __construct(string $apiKey, LoggerInterface $logger)
    {
        $this->apiKey = $apiKey;
        $this->logger = $logger;
        $this->client = new Client([
            'base_uri' => 'https://api.stormglass.io',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getWeather(float $lon, float $lat): ?Weather
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));
        $data = null;

        try {
            $headers = [
                'Authorization' => $this->apiKey
            ];

            $response = $this->client->get('/v2/weather/point', [
                'query' => [
                    'lng' => $lon,
                    'lat' => $lat,
                    'params' => 'airTemperature',
                    'start' => $dateTime->format('Y-m-d H:i:s'),
                    'end' => $dateTime->format('Y-m-d H:i:s'),
                ],
                'headers' => $headers
            ]);
            $responseData = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            $data = $this->processResponse($responseData, $lon, $lat);
        } catch (RequestException $e) {
            $this->logger->warning('Bad weather provider response', [
                'provider' => self::PROVIDER_NAME,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
        return $data;
    }

    private function processResponse(array $responseData, float $lon, float $lat): ?Weather
    {
        $weather = new Weather();
        $weather->setLon($lon);
        $weather->setLat($lat);
        $weather->setWeatherProvider(self::PROVIDER_NAME);
        $weather->setAirTemperature($responseData['hours']['0']['airTemperature']['noaa']);
        return $weather;
    }
}
