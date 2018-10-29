<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreenHasDeckRepository")
 */
class ScreenHasDeck
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Screen", inversedBy="screenHasDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $screen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deck")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deck;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    public function __toString(): string
    {
        return $this->getScreen()->getName()
            . '-'
            . $this->getPosition()
            .'->'
            . $this->getDeck()->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScreen(): ?Screen
    {
        return $this->screen;
    }

    public function setScreen(?Screen $screen): self
    {
        $this->screen = $screen;

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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(?bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }
}
