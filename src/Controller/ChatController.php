<?php

// src/Controller/ChatController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Entity\Conversation; 



class ChatController extends AbstractController
{
    /**
     * @[Route"/chat/{id}", name:"chat")]
     */
    public function chat()
    {

        $message = new Message();
    $form = $this->createFormBuilder($message)
        ->add('content', TextType::class, [
            'label' => 'Votre message'
        ])
        ->add('send', SubmitType::class, [
            'label' => 'Envoyer'
        ])
        ->getForm();

    // Rendre le formulaire dans votre template
    return $this->render('chat/chat.html.twig', [
        'form' => $form->createView(),
    ]);
    }


    public function __construct(private UserRepository $userRepository)
    {
    }
    public function getUserFromInterface()
    {
        return $this->userRepository->findOneBy(["email" => $this->getUser()->getUserIdentifier()]);
    }

    // Dans votre contrôleur Symfony


  #[Route('/chat/conversation', name:'conversation')]
public function Conversation(EntityManagerInterface $em, Security $security): Response
{
    $user = $security->getUser(); // Récupère l'utilisateur actuel
    $userId = $this->getUserFromInterface(); // Ou la méthode appropriée pour obtenir l'ID de l'utilisateur

    // Récupérer les conversations où l'utilisateur est impliqué
    $conversations = $em->getRepository(Conversation::class)->findBy([
        'user_id_1' => $userId,
        // Ajouter des conditions pour user_id2, user_id3, etc. si nécessaire
    ]);

    return $this->render('chat/conversation.html.twig', [
        'conversations' => $conversations
    ]);
}




#[Route('/get-messages/{id}', name: 'get_messages')]
public function getMessages(EntityManagerInterface $entityManager)
{
    $id = 1;
    $messageRepository = $entityManager->getRepository(Message::class);

    // Récupère les messages de la conversation spécifique
    $messages = $messageRepository->findBy(['conversation' => $id]);

    $messagesArray = [];
    foreach ($messages as $message) {
        $messagesArray[] = [
            'id' => $message->getId(),
            'content' => $message->getContent(),
            'createdAt' => $message->getCreatedAt()->format('Y-m-d H:i:s'),
            'author_id' => $message->getUser()->getId(),        ];
    }

    return new JsonResponse($messagesArray);
}

    /**
     * @Route("/send-message", name="send_message", methods={"POST"})
     */
    public function sendMessage(Request $request, SessionInterface $session, Security $security, EntityManagerInterface $entityManager)
    {

            $data = json_decode($request->getContent(), true);
            
            if (!isset($data['message'])) {
                return new JsonResponse(['status' => 'error', 'message' => 'Données invalides'], 400);
            }
        
            $user = $security->getUser();
            if (!$user) {
                return new JsonResponse(['status' => 'error', 'message' => 'Utilisateur non authentifié'], 403);
            }

            $message = new Message();
            $message->setContent($data['message']);
            $message->setCreatedAt(new \DateTimeImmutable());
            $message->setUser($user); 
        
            $entityManager->persist($message);
            $entityManager->flush();
        
            return new JsonResponse(['status' => 'success', 'message' => 'Message envoyé']);
        } 
    
    }

