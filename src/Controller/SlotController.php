<?php

namespace App\Controller;

use App\Entity\Slot;
use App\Form\SlotType;
use App\Repository\SlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/slot')]
#[IsGranted(new Expression('is_granted("ROLE_COACH")'))]
class SlotController extends AbstractController
{
    #[Route('/', name: 'app_slot_index', methods: ['GET'])]
    public function index(SlotRepository $slotRepository): Response
    {
        return $this->render('slot/index.html.twig', [
            'slots' => $slotRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_slot_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $slot = new Slot();
        $form = $this->createForm(SlotType::class, $slot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($slot);
            $entityManager->flush();

            $this->addFlash("green", "Créneau ajouté.");
            return $this->redirectToRoute('app_slot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('slot/new.html.twig', [
            'slot' => $slot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_slot_show', methods: ['GET'])]
    public function show(Slot $slot): Response
    {
        return $this->render('slot/show.html.twig', [
            'slot' => $slot,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_slot_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Slot $slot, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SlotType::class, $slot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("blue", "Créneau modifié.");
            return $this->redirectToRoute('app_slot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('slot/edit.html.twig', [
            'slot' => $slot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_slot_delete', methods: ['POST'])]
    public function delete(Request $request, Slot $slot, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $slot->getId(), $request->request->get('_token'))) {
            $entityManager->remove($slot);
            $entityManager->flush();
        }

        $this->addFlash("red", "Créneau supprimé.");
        return $this->redirectToRoute('app_slot_index', [], Response::HTTP_SEE_OTHER);
    }
}
