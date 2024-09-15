<?php
// src/Controller/TestController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class TestController extends AbstractController
{
    #[Route('/test/calendar', name: 'test_calendar')]
    public function calendar(): Response
    {
        return $this->render('calendar_test.html.twig');
    }
    #[Route('/test/calendar/events', name: 'calendar_events')]
    public function getEvents(): JsonResponse
    {
        // Exemple d'événements
        $events = [
            ['title' => 'Event 1', 'start' => '2024-09-15'],
            ['title' => 'Event 2', 'start' => '2024-09-16'],
        ];

        return new JsonResponse($events);
    }
}
