<?php

namespace Trivia;

class Player
{
    /** @var  int */
    private $numPurses;

    /** @var string */
    private $name;

    /** @var int */
    private $place;

    /** @var bool */
    private $isInPenaltyBox;

    /** @var  bool */
    private $isGettingOutOfPenaltyBox;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->place = 0;
        $this->numPurses = 0;
        $this->isInPenaltyBox = false;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function position()
    {
        return $this->place;
    }

    /**
     * @param int $newPosition
     */
    public function moveTo($newPosition)
    {
        $this->place = $newPosition;
    }

    /**
     *
     */
    public function winPurse()
    {
        $this->numPurses++;
    }

    /**
     * @return int
     */
    public function purses()
    {
        return $this->numPurses;
    }

    /**
     * @return bool
     */
    public function isInPenaltyBox()
    {
        return $this->isInPenaltyBox;
    }

    public function gotoPenaltyBox()
    {
        $this->isInPenaltyBox = true;
    }

    /**
     * @param boolean $gettingOut
     */
    public function gettingOutOfPenaltyBox($gettingOut)
    {
        $this->isGettingOutOfPenaltyBox = $gettingOut;
    }

    /**
     * @return bool
     */
    public function isGettingOutOfPenaltyBox()
    {
        return $this->isGettingOutOfPenaltyBox;
    }
}