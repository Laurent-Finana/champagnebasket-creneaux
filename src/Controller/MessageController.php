<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/message')]
#[IsGranted(new Expression('is_granted("ROLE_PLAYER")'))]
class MessageController extends AbstractController
{
    #[Route('/', name: 'app_message')]
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    #[Route('/send', name: 'app_message_send')]
    public function send(Request $request, EntityManagerInterface $em): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());

            $em->persist($message);
            $em->flush();

            $this->addFlash("green", "Message envoyé avec succès.");
            return $this->redirectToRoute("app_message_received");
        }

        return $this->render("message/send.html.twig", [
            "form" => $form
        ]);
    }

    #[Route('/received', name: 'app_message_received')]
    public function received(MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findAllOrderedByDate();
        dump($messages);

        return $this->render('message/received.html.twig', [
            "messages" => $messages
        ]);
    }

    #[Route('/sent', name: 'app_message_sent')]
    public function sent(): Response
    {
        return $this->render('message/sent.html.twig');
    }

    #[Route('/read/received/{id}', name: 'app_message_read_received')]
    public function read_received(Message $message, EntityManagerInterface $em): Response
    {
        $message->setIsRead(true);
        $em->persist($message);
        $em->flush();
        return $this->render('message/read-received.html.twig', compact("message"));
    }

    #[Route('/read/sent/{id}', name: 'app_message_read_sent')]
    public function read_sent(Message $message, EntityManagerInterface $em): Response
    {
        $message->setIsRead(true);
        $em->persist($message);
        $em->flush();
        return $this->render('message/read-sent.html.twig', compact("message"));
    }

    #[Route('/delete/{id}', name: 'app_message_delete')]
    public function delete(Message $message, EntityManagerInterface $em): Response
    {
        $em->remove($message);
        $em->flush();

        $this->addFlash("red", "Le message a bien été supprimé.");
        return $this->redirectToRoute("app_message_received");
    }
}
