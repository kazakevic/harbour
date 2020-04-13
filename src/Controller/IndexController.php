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
        if ($request->get('lon') && $request->get('lat')) {
            $response = new JsonResponse($service->getWeather(
                $request->get('lon'),
                $request->get('lat')
            )->getSerializedWeather());
        } else {
            $response = new JsonResponse('Weather API error', 400);
        }
        return $response;
    }
}
