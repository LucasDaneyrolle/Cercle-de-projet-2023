<?php

// src/Controller/ChatController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use App\Entity\User;  
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class ChatController extends AbstractController
{
      /**
     * @Route("/chat", name="chat")
     */

     public function chat(Request $request, EntityManagerInterface $entityManager, Security $security)
{
    $message = new Message();
    $form = $this->createFormBuilder($message)
        ->add('Content', TextType::class)
        ->add('send', SubmitType::class, ['label' => 'Envoyer'])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        
            $data = json_decode($request->getContent(), true);
            $user = $security->getUser();
    
            if (!$user) {
                return new JsonResponse(['status' => 'error', 'message' => 'Utilisateur non authentifié'], 403);
            }
    
            $message = new Message();
            $message->setContent($data['message']);
            $message->setCreatedAt(new \DateTimeImmutable());
            $message->setUserId($user->getId());
            $message->setConversationId($data['conversationId']);
    
            $entityManager->persist($message);
            $entityManager->flush();
    
            return new JsonResponse(['status' => 'success']);
        
    }

    return $this->render('chat/chat.html.twig', [
        'form' => $form->createView(),
    ]);
}


    /**
     * @Route("/get-messages/{conversationId}", name="get_messages")
     */
    public function getMessages($conversationId, EntityManagerInterface $entityManager, Security $security)
    {
        $user = $security->getUser();
        if (!$user) {
            return new JsonResponse(['status' => 'error', 'message' => 'Utilisateur non authentifié'], 403);
        }

        $messageRepository = $entityManager->getRepository(Message::class);
        $messages = $messageRepository->findBy(['conversation' => $conversationId]);

        $messagesArray = [];
        foreach ($messages as $message) {
            $messagesArray[] = [
                'id' => $message->getId(),
                'content' => $message->getContent(),
                // Ajoutez d'autres propriétés nécessaires
            ];
        }

        return new JsonResponse($messagesArray);
    }



    
    /*/**
     * @Route("/send-message", name="send_message", methods={"POST"})
     */
   
}
