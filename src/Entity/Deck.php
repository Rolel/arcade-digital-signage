<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckRepository")
 */
class Deck
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeckHasSlide", mappedBy="deck", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"position"="ASC"})
     */
    private $deckHasSlides;

    public function __construct()
    {
        $this->slides = new ArrayCollection();
        $this->deckHasSlides = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|DeckHasSlide[]
     */
    public function getDeckHasSlides(): Collection
    {
        return $this->deckHasSlides;
    }

    public function addDeckHasSlide(DeckHasSlide $deckHasSlide): self
    {
        if (!$this->deckHasSlides->contains($deckHasSlide)) {
            $this->deckHasSlides[] = $deckHasSlide;
            $deckHasSlide->setDeck($this);
        }

        return $this;
    }

    public function removeDeckHasSlide(DeckHasSlide $deckHasSlide): self
    {
        if ($this->deckHasSlides->contains($deckHasSlide)) {
            $this->deckHasSlides->removeElement($deckHasSlide);
            // set the owning side to null (unless already changed)
            if ($deckHasSlide->getDeck() === $this) {
                $deckHasSlide->setDeck(null);
            }
        }

        return $this;
    }
}
