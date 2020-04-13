<?php

namespace App\Service\Weather;

use App\Model\Weather;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class OpenWeatherMapProviderService implements WeatherProviderInterface
{
    /** @var string */
    private $apiKey;

    /** @var Client */
    private $client;

    /** @var LoggerInterface */
    private $logger;

    private const PROVIDER_NAME = 'OpenWeatherMap';

    public function __construct(string $apiKey, LoggerInterface $logger)
    {
        $this->apiKey = $apiKey;
        $this->logger = $logger;
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getWeather(float $lon, float $lat): ?Weather
    {
        $data = null;
        try {
            $response = $this->client->get('/data/2.5/weather', [
                'query' => [
                    'lon' => $lon,
                    'lat' => $lat,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            ]);
            $responseData = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            $data = $this->processResponse($responseData, $lon, $lat);
        } catch (RequestException $e) {
            $this->logger && $this->logger->warning('Bad weather provider response', [
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
        $weather->setAirTemperature($responseData['main']['temp']);
        return $weather;
    }
}
