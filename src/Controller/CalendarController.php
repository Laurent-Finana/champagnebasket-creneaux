<?php

namespace App\Controller;

use App\Repository\SlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/grande-salle', name: 'app_calendar_grande_salle')]
    public function index(SlotRepository $slot): Response
    {
        $events = $slot->findAll();

        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'description' => $event->getDescription(),
                'allDay' => $event->isAllDay(),
                'backgroundColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('calendar/index-grande-salle.html.twig', compact('data'));
    }
}
