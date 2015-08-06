<?php

namespace Trivia;

class Player
{
    /** @var string */
    private $name;

    /** @var  int */
    private $numPurses;

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
     * @return Position
     */
    public function position()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function positionValue()
    {
        return $this->position->value();
    }

    /**
     * @param $roll
     */
    public function move($roll)
    {
        $this->position = $this->position->move($roll);
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

    public function question()
    {
        return $this->position->question();
    }
}