<?php

namespace App\Controller;

use DateTime;
use App\Entity\Slot;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'app_api_event_edit', methods: ['PUT'])]
    public function majEvent(?Slot $slot, Request $request, ManagerRegistry $doctrine): Response
    {
        $userData = json_decode($request->getContent());

        if (
            isset($userData->title) && !empty($userData->title) &&
            isset($userData->start) && !empty($userData->start) &&
            isset($userData->end) && !empty($userData->end) &&
            isset($userData->description) && !empty($userData->description) &&
            isset($userData->backgroundColor) && !empty($userData->backgroundColor) &&
            isset($userData->textColor) && !empty($userData->textColor)
        ) {
            $code = 200;
            if (!$slot) {
                $slot = new Slot;

                $code = 201;
            }

            $slot->setTitle($userData->title);
            $slot->setStart(new DateTime($userData->start));
            if ($userData->allDay) {
                $slot->setEnd(new DateTime($userData->start));
            } else {
                $slot->setEnd(new DateTime($userData->end));
            }
            $slot->setAllDay($userData->allDay);
            $slot->setDescription($userData->description);
            $slot->setBackgroundColor($userData->backgroundColor);
            $slot->setTextColor($userData->textColor);

            $em = $doctrine->getManager();
            $em->persist($slot);
            $em->flush();

            return new Response('ok', $code);
        } else {
            return new Response('Données incomplètes', 404);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
