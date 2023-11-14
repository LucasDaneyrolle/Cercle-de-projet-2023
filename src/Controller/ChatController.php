<?php

// src/Controller/ChatController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function chat()
    {
        return $this->render('chat/chat.html.twig');
    }

    /**
     * @Route("/get-messages", name="get_messages")
     */
    public function getMessages(SessionInterface $session)
    {
        $messages = $session->get('chat_messages', []);

        return new JsonResponse($messages);
    }

    /**
     * @Route("/send-message", name="send_message", methods={"POST"})
     */
    public function sendMessage(Request $request, SessionInterface $session)
    {
        $data = json_decode($request->getContent(), true);

        $messages = $session->get('chat_messages', []);
        $messages[] = $data['message'];
        $session->set('chat_messages', $messages);

        return new JsonResponse(['status' => 'success']);
    }
}
