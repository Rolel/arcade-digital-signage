<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreenRepository")
 */
class Screen
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
     * @ORM\OneToMany(targetEntity="App\Entity\ScreenHasDeck", mappedBy="screen", orphanRemoval=true, cascade={"persist"})
     * @ORM\OrderBy({"position"="ASC"})
     */
    private $screenHasDecks;

    public function __construct()
    {
        $this->decks = new ArrayCollection();
        $this->screenHasDecks = new ArrayCollection();
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
     * @return Collection|ScreenHasDeck[]
     */
    public function getScreenHasDecks(): Collection
    {
        return $this->screenHasDecks;
    }

    public function addScreenHasDeck(ScreenHasDeck $screenHasDeck): self
    {
        if (!$this->screenHasDecks->contains($screenHasDeck)) {
            $this->screenHasDecks[] = $screenHasDeck;
            $screenHasDeck->setScreen($this);
        }

        return $this;
    }

    public function removeScreenHasDeck(ScreenHasDeck $screenHasDeck): self
    {
        if ($this->screenHasDecks->contains($screenHasDeck)) {
            $this->screenHasDecks->removeElement($screenHasDeck);
            // set the owning side to null (unless already changed)
            if ($screenHasDeck->getScreen() === $this) {
                $screenHasDeck->setScreen(null);
            }
        }

        return $this;
    }
}
