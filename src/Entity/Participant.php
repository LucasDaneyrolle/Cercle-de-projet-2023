<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $conversation_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $message_read_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getConversationId(): ?int
    {
        return $this->conversation_id;
    }

    public function setConversationId(int $conversation_id): static
    {
        $this->conversation_id = $conversation_id;

        return $this;
    }

    public function getMessageReadAt(): ?\DateTimeImmutable
    {
        return $this->message_read_at;
    }

    public function setMessageReadAt(\DateTimeImmutable $message_read_at): static
    {
        $this->message_read_at = $message_read_at;

        return $this;
    }
}
