<?php
// src/Controller/CalendarController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class CalendarController extends AbstractController
{
    #[Route('/admin/calendar', name: 'calendar_page')]
    public function showCalendar(): Response
    {
        return $this->render('admin/calendar.html.twig');
    }
}
