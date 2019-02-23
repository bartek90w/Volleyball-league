<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeagueTableRepository")
 */
class LeagueTable
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
    private $points=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchesPlayed=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchesWin=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchesLost=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $setsWin=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $setsLost=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointsWin=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointsLost=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result30=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result31=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result32=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result23=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result13=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $result03=0;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\League", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $league;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Team", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getMatchesPlayed(): ?int
    {
        return $this->matchesPlayed;
    }

    public function setMatchesPlayed(int $matchesPlayed): self
    {
        $this->matchesPlayed = $matchesPlayed;

        return $this;
    }

    public function getMatchesWin(): ?int
    {
        return $this->matchesWin;
    }

    public function setMatchesWin(int $matchesWin): self
    {
        $this->matchesWin = $matchesWin;

        return $this;
    }

    public function getMatchesLost(): ?int
    {
        return $this->matchesLost;
    }

    public function setMatchesLost(int $matchesLost): self
    {
        $this->matchesLost = $matchesLost;

        return $this;
    }

    public function getSetsWin(): ?int
    {
        return $this->setsWin;
    }

    public function setSetsWin(int $setsWin): self
    {
        $this->setsWin = $setsWin;

        return $this;
    }

    public function getSetsLost(): ?int
    {
        return $this->setsLost;
    }

    public function setSetsLost(int $setsLost): self
    {
        $this->setsLost = $setsLost;

        return $this;
    }

    public function getPointsWin(): ?int
    {
        return $this->pointsWin;
    }

    public function setPointsWin(int $pointsWin): self
    {
        $this->pointsWin = $pointsWin;

        return $this;
    }

    public function getPointsLost(): ?int
    {
        return $this->pointsLost;
    }

    public function setPointsLost(int $pointsLost): self
    {
        $this->pointsLost = $pointsLost;

        return $this;
    }

    public function getResult30(): ?int
    {
        return $this->result30;
    }

    public function setResult30(int $result30): self
    {
        $this->result30 = $result30;

        return $this;
    }

    public function getResult31(): ?int
    {
        return $this->result31;
    }

    public function setResult31(int $result31): self
    {
        $this->result31 = $result31;

        return $this;
    }

    public function getResult32(): ?int
    {
        return $this->result32;
    }

    public function setResult32(int $result32): self
    {
        $this->result32 = $result32;

        return $this;
    }

    public function getResult23(): ?int
    {
        return $this->result23;
    }

    public function setResult23(int $result23): self
    {
        $this->result23 = $result23;

        return $this;
    }

    public function getResult13(): ?int
    {
        return $this->result13;
    }

    public function setResult13(int $result13): self
    {
        $this->result13 = $result13;

        return $this;
    }

    public function getResult03(): ?int
    {
        return $this->result03;
    }

    public function setResult03(int $result03): self
    {
        $this->result03 = $result03;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
