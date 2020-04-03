<?php

namespace App\Entity;

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
    private $front_formating;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $back_formating;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CardType", inversedBy="card_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_id;

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

    public function getFrontFormating(): ?string
    {
        return $this->front_formating;
    }

    public function setFrontFormating(?string $front_formating): self
    {
        $this->front_formating = $front_formating;

        return $this;
    }

    public function getBackFormating(): ?string
    {
        return $this->back_formating;
    }

    public function setBackFormating(?string $back_formating): self
    {
        $this->back_formating = $back_formating;

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
}
