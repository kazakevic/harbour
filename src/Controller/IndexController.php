<?php

namespace App\Controller;

use App\Service\Weather\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    public function index()
    {
        return $this->render('page/index.html.twig', [
        ]);
    }

    public function weather(Request $request, WeatherService $service)
    {
        $lon = $request->get('lon');
        $lat = $request->get('lat');
        return new JsonResponse($service->getWeather($lon, $lat)->getAirTemperature());
    }
}
