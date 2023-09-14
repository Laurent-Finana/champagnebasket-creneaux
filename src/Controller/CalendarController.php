<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/grande-salle', name: 'app_calendar_grande_salle')]
    public function index(): Response
    {
        return $this->render('calendar/index-grande-salle.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
