<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardSettingsRepository")
 */
class CardSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="smallint")
     */
    private $again;

    /**
     * @ORM\Column(type="smallint")
     */
    private $easy;

    /**
     * @ORM\Column(type="smallint")
     */
    private $normal;

    /**
     * @ORM\Column(type="smallint")
     */
    private $hard;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_time_stadied;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Card", inversedBy="cardSettings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getAgain(): ?int
    {
        return $this->again;
    }

    public function setAgain(int $again): self
    {
        $this->again = $again;

        return $this;
    }

    public function getEasy(): ?int
    {
        return $this->easy;
    }

    public function setEasy(int $easy): self
    {
        $this->easy = $easy;

        return $this;
    }

    public function getNormal(): ?int
    {
        return $this->normal;
    }

    public function setNormal(int $normal): self
    {
        $this->normal = $normal;

        return $this;
    }

    public function getHard(): ?int
    {
        return $this->hard;
    }

    public function setHard(int $hard): self
    {
        $this->hard = $hard;

        return $this;
    }

    public function getLastTimeStadied(): ?\DateTimeInterface
    {
        return $this->last_time_stadied;
    }

    public function setLastTimeStadied(?\DateTimeInterface $last_time_stadied): self
    {
        $this->last_time_stadied = $last_time_stadied;

        return $this;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }
}
