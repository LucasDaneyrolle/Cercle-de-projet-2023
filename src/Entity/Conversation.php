<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $user_id_1 = null;

    #[ORM\Column]
    private ?int $user_id_2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id_3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id_4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id_5 = null;

    #[ORM\ManyToMany(targetEntity: Message::class, mappedBy: 'conversation')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUserId1(): ?int
    {
        return $this->user_id_1;
    }

    public function setUserId1(int $user_id_1): static
    {
        $this->user_id_1 = $user_id_1;

        return $this;
    }

    public function getUserId2(): ?int
    {
        return $this->user_id_2;
    }

    public function setUserId2(int $user_id_2): static
    {
        $this->user_id_2 = $user_id_2;

        return $this;
    }

    public function getUserId3(): ?int
    {
        return $this->user_id_3;
    }

    public function setUserId3(?int $user_id_3): static
    {
        $this->user_id_3 = $user_id_3;

        return $this;
    }

    public function getUserId4(): ?int
    {
        return $this->user_id_4;
    }

    public function setUserId4(?int $user_id_4): static
    {
        $this->user_id_4 = $user_id_4;

        return $this;
    }

    public function getUserId5(): ?int
    {
        return $this->user_id_5;
    }

    public function setUserId5(?int $user_id_5): static
    {
        $this->user_id_5 = $user_id_5;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->addConversation($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            $message->removeConversation($this);
        }

        return $this;
    }
}
