<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
    
    #[Route('/events/list', name: 'app_event_list')]
    public function eventList(): Response
    {
        return $this->render('event/eventList.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
