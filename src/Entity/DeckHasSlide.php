<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckHasSlideRepository")
 */
class DeckHasSlide
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deck", inversedBy="deckHasSlides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Slide")
     * @ORM\JoinColumn(nullable=false)
     */
    private $slide;

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
        return $this->getDeck()->getName()
            . '-'
            . $this->getPosition()
            .'->'
            . $this->getSlide()->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    public function setSlide(?Slide $slide): self
    {
        $this->slide = $slide;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enabled): self
    {
        $this->enable = $enabled;

        return $this;
    }
}
