<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EventController extends AbstractController
{
    #[Route('/new_event', name: 'app_new_event')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $event->setUser($this->getUser());
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_new_event');
        }

        return $this->render('event/new.html.twig', [
            'controller_name' => 'EventController',
            'eventForm' => $form
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events(EntityManagerInterface $em): Response
    {
        $events = $em->getRepository(Event::class)->findAll();

        return $this->render('event/events.html.twig', [
            'events' => $events
        ]);
    }

    #[Route('/events/{id}', name: 'app_event_view')]
    public function eventView(Event $event): Response
    {
        return $this->render('event/event-view.html.twig', [
            'event' => $event
        ]);
    }
}
