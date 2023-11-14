<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Last_message_id = null;

    #[ORM\Column]
    private ?int $User_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastMessageId(): ?int
    {
        return $this->Last_message_id;
    }

    public function setLastMessageId(int $Last_message_id): static
    {
        $this->Last_message_id = $Last_message_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->User_id;
    }

    public function setUserId(int $User_id): static
    {
        $this->User_id = $User_id;

        return $this;
    }
}
