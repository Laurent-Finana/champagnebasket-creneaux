<?php

namespace App\Controller;

use App\Repository\SlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted(new Expression('is_remember_me() or is_fully_authenticated()'))]
#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/grande-salle', name: 'app_calendar_grande_salle')]
    public function index_grande_salle(SlotRepository $slot): Response
    {
        $events = $slot->findByRoom(1);

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

    #[Route('/petite-salle', name: 'app_calendar_petite_salle')]
    public function index_petite_salle(SlotRepository $slot): Response
    {
        $events = $slot->findByRoom(2);

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

        return $this->render('calendar/index-petite-salle.html.twig', compact('data'));
    }

    #[Route('/musculation', name: 'app_calendar_musculation')]
    public function index_musculation(SlotRepository $slot): Response
    {
        $events = $slot->findByRoom(3);

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

        return $this->render('calendar/index-musculation.html.twig', compact('data'));
    }
}
