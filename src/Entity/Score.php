<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Score
{

    const RAW2VALUEPATTERN_TIME = '/(?:(\d+)(?:h[A-Za-z]*|:){1})?(?:(\d+)(?:m[A-Za-z]*|:){1})?(\d+)(?:s[A-Za-z]*)*/';
    const RAW2VALUEPATTERN_SCORE = '/(\d+).*/';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Scoreboard", inversedBy="scores")
     */
    private $scoreboard;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playername;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rawvalue;

    public function __toString()
    {
        // $unit = Scoreboard::TYPES_UNIT[$this->getScoreboard()->getType()];
        return $this->getPlayername() . ' - ' . $this->getRawvalue();
    }

    /**
     * AKA Doing some magic things that will get uncontrollable someday
     * @ORM\PreFlush
     */
    public function setValueFromRawValue()
    {
        $computedValue = null;

        // Extracting numericalvalues - quite generic so we start with this one
        if (preg_match(self::RAW2VALUEPATTERN_SCORE, $this->rawvalue, $score)) {
            $computedValue = $score[1];
        }

        // Extracting XminYsec
        if (preg_match(self::RAW2VALUEPATTERN_TIME, $this->rawvalue, $time)) {
            $computedValue = intval($time[1]) * 3600 + intval($time[2]) * 60 + $time[3];
        }

        if ($computedValue != null) {
            $this->value = $computedValue;
        }
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPlayername(): ?string
    {
        return $this->playername;
    }

    public function setPlayername(string $playername): self
    {
        $this->playername = $playername;

        return $this;
    }

    public function getRawvalue(): ?string
    {
        return $this->rawvalue;
    }

    public function setRawvalue(string $rawvalue): self
    {
        $this->rawvalue = $rawvalue;

        return $this;
    }
}
