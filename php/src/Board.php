<?php

namespace Trivia;

class Board
{

    /**
     * Board constructor.
     */
    public function __construct()
    {
    }

    public function initialPosition()
    {
        return new Position(0, $this);
    }

    public function move(Position $position, $roll)
    {
        return new Position(($position->value() + $roll) % 12, $this);
    }
}