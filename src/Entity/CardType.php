<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardTypeRepository")
 */
class CardType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true,  nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Card", mappedBy="type_id")
     */
    private $card_id;

    public function __construct()
    {
        $this->card_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCardId(): Collection
    {
        return $this->card_id;
    }

    public function addCardId(Card $cardId): self
    {
        if (!$this->card_id->contains($cardId)) {
            $this->card_id[] = $cardId;
            $cardId->setTypeId($this);
        }

        return $this;
    }

    public function removeCardId(Card $cardId): self
    {
        if ($this->card_id->contains($cardId)) {
            $this->card_id->removeElement($cardId);
            // set the owning side to null (unless already changed)
            if ($cardId->getTypeId() === $this) {
                $cardId->setTypeId(null);
            }
        }

        return $this;
    }
}
