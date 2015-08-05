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

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->place = 0;
        $this->numPurses = 0;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

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

    public function winPurse()
    {
        $this->numPurses++;
    }

    public function purses()
    {
        return $this->numPurses;
    }

}