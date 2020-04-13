<?php

namespace App\Service\Weather;

use App\Model\Weather;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class WeatherService
{
    /** @var WeatherProviderInterface[] */
    private $weatherProviders = [];

    /** @var LoggerInterface */
    private $logger;

    /** @var FilesystemAdapter */
    private $cache;

    /**
     * @var int
     * 30 min
     */
    private const WEATHER_TTL = 1800;

    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    public function addProvider(string $name, WeatherProviderInterface $service)
    {
        $this->weatherProviders[$name] = $service;
    }

    public function getWeather(float $lon, float $lat): ?Weather
    {
        foreach ($this->weatherProviders as $provider) {
            if ($provider->getWeather($lon, $lat)) {
                return $this->cache->get('weather_'. $lon . '_' . $lat, function (ItemInterface $item) use (
                    $provider,
                    $lon,
                    $lat
                ) {
                    $item->expiresAfter(self::WEATHER_TTL);
                    return $provider->getWeather($lon, $lat);
                });
            }
        }
        $this->logger->warning('All weather providers are not available');
        return null;
    }
}
