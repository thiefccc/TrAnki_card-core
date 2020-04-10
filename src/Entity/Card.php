<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $front_value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $back_value;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $front_formatting;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $back_formatting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CardType", inversedBy="card_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deck", inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deck;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time_created;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CardSettings", mappedBy="card", orphanRemoval=true)
     */
    private $cardSettings;

    public function __construct()
    {
        $this->cardSettings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrontValue(): ?string
    {
        return $this->front_value;
    }

    public function setFrontValue(?string $front_value): self
    {
        $this->front_value = $front_value;

        return $this;
    }

    public function getBackValue(): ?string
    {
        return $this->back_value;
    }

    public function setBackValue(?string $back_value): self
    {
        $this->back_value = $back_value;

        return $this;
    }

    public function getFrontFormatting(): ?string
    {
        return $this->front_formatting;
    }

    public function setFrontFormating(?string $front_formatting): self
    {
        $this->front_formatting = $front_formatting;

        return $this;
    }

    public function getBackFormatting(): ?string
    {
        return $this->back_formatting;
    }

    public function setBackFormatting(?string $back_formatting): self
    {
        $this->back_formatting = $back_formatting;

        return $this;
    }

    public function getTypeId(): ?CardType
    {
        return $this->type_id;
    }

    public function setTypeId(?CardType $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getDeck(): ?Deck
    {
        return $this->deck;
    }

    public function setDeck(?Deck $deck): self
    {
        $this->deck = $deck;

        return $this;
    }

    public function getTimeCreated(): ?\DateTimeInterface
    {
        return $this->time_created;
    }

    public function setTimeCreated(\DateTimeInterface $time_created): self
    {
        $this->time_created = $time_created;

        return $this;
    }

    /**
     * @return Collection|CardSettings[]
     */
    public function getCardSettings(): Collection
    {
        return $this->cardSettings;
    }

    public function addCardSetting(CardSettings $cardSetting): self
    {
        if (!$this->cardSettings->contains($cardSetting)) {
            $this->cardSettings[] = $cardSetting;
            $cardSetting->setCard($this);
        }

        return $this;
    }

    public function removeCardSetting(CardSettings $cardSetting): self
    {
        if ($this->cardSettings->contains($cardSetting)) {
            $this->cardSettings->removeElement($cardSetting);
            // set the owning side to null (unless already changed)
            if ($cardSetting->getCard() === $this) {
                $cardSetting->setCard(null);
            }
        }

        return $this;
    }
}
