<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreboardRepository")
 */
class Scoreboard
{
    const TYPES = [
        10 => 'Time (Min & Sec)',
        11 => 'Time (Sec)',

        20 => 'Score (Pts)',
        21 => 'Score (Money $)',
        22 => 'Score (Money €)'
    ];

    const TYPES_FORMAT = [
        10 => 'i\ms\s',
        11 => 's\s',

        20 => 'pts',
        21 => 'USD',
        22 => 'EUR'
    ];



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
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Score", mappedBy="scoreboard", cascade={"persist"})
     * @ORM\OrderBy({"value"="DESC"})
     */
    private $scores;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="scoreboard")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
    }

    public function __toString(): string
    {
        $output = '';
        if ($this->getType() != null && $this->getGame() != null) {
            $type = self::TYPES[$this->getType()];
            $game = $this->getGame()->getName();

            $output = $this->getName() . ' on ' . $game . ' - ' . $type;
        }
        return $output;
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setScoreboard($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->contains($score)) {
            $this->scores->removeElement($score);
            // set the owning side to null (unless already changed)
            if ($score->getScoreboard() === $this) {
                $score->setScoreboard(null);
            }
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
