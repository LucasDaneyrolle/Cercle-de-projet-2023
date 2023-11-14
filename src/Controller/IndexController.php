<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('pages/connexion.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/messages', name: 'app_messages')]
    public function messages(): Response
    {
        return $this->render('pages/messages.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/calendar', name: 'app_calendar')]
    public function calendar(): Response
    {
        return $this->render('pages/calendar.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/lessons', name: 'app_lessons')]
    public function lessons(): Response
    {
        return $this->render('pages/lessons.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events(): Response
    {
        return $this->render('pages/events.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
