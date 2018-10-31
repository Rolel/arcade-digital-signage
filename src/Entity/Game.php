<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="games")
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCategory", inversedBy="games")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scoreboard", mappedBy="game", orphanRemoval=true)
     */
    private $scoreboard;

    public function __construct()
    {
        $this->brand = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->scoreboard = new ArrayCollection();
    }

    public function __toString(): ?string
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

    /**
     * @return Collection|Brand[]
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function addBrand(Brand $brand): self
    {
        if (!$this->brand->contains($brand)) {
            $this->brand[] = $brand;
        }

        return $this;
    }

    public function removeBrand(Brand $brand): self
    {
        if ($this->brand->contains($brand)) {
            $this->brand->removeElement($brand);
        }

        return $this;
    }

    /**
     * @return GameCategory
     */
    public function getCategory(): ?GameCategory
    {
        return $this->category;
    }

    public function addCategory(GameCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(GameCategory $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Scoreboard[]
     */
    public function getScoreboard(): Collection
    {
        return $this->scoreboard;
    }

    public function addScoreboard(Scoreboard $scoreboard): self
    {
        if (!$this->scoreboard->contains($scoreboard)) {
            $this->scoreboard[] = $scoreboard;
            $scoreboard->setGame($this);
        }

        return $this;
    }

    public function removeScoreboard(Scoreboard $scoreboard): self
    {
        if ($this->scoreboard->contains($scoreboard)) {
            $this->scoreboard->removeElement($scoreboard);
            // set the owning side to null (unless already changed)
            if ($scoreboard->getGame() === $this) {
                $scoreboard->setGame(null);
            }
        }

        return $this;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function setCategory(?GameCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
