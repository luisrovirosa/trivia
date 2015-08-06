<?php

namespace Trivia;

class Player
{
    /** @var string */
    private $name;

    /** @var  int */
    private $numPurses;

    /** @var int */
    private $place;

    /** @var bool */
    private $isInPenaltyBox;

    /** @var  bool */
    private $isGettingOutOfPenaltyBox;

    /**
     * @var Position
     */
    private $position;

    /**
     * Player constructor.
     * @param string $name
     * @param Position $position
     */
    public function __construct($name, Position $position)
    {
        $this->name = $name;
        $this->place = 0;
        $this->numPurses = 0;
        $this->isInPenaltyBox = false;
        $this->position = $position;
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
     * @param $roll
     */
    public function moveTo($roll)
    {
        $this->position = $this->position->move($roll);

        $this->place = $this->position->value();
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