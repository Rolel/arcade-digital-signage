<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SlideRepository")
 */
class Slide
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Scoreboard")
     */
    private $scoreboard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $count;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showtitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $autoscroll;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $direction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCategory")
     */
    private $gametype;

    public function __toString(): string
    {
        return $this->name ?? '';
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getScoreboard(): ?Scoreboard
    {
        return $this->scoreboard;
    }

    public function setScoreboard(?Scoreboard $scoreboard): self
    {
        $this->scoreboard = $scoreboard;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getShowtitle(): ?bool
    {
        return $this->showtitle;
    }

    public function setShowtitle(bool $showtitle): self
    {
        $this->showtitle = $showtitle;

        return $this;
    }

    public function getAutoscroll(): ?bool
    {
        return $this->autoscroll;
    }

    public function setAutoscroll(bool $autoscroll): self
    {
        $this->autoscroll = $autoscroll;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getGametype(): ?GameCategory
    {
        return $this->gametype;
    }

    public function setGametype(?GameCategory $gametype): self
    {
        $this->gametype = $gametype;

        return $this;
    }
}
