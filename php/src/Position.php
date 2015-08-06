<?php

namespace Trivia;

class Position
{
    /**
     * @var int
     */
    private $value;
    /**
     * @var Board
     */
    private $board;

    /**
     * Position constructor.
     * @param int $value
     * @param Board $board
     */
    public function __construct($value, Board $board)
    {
        $this->value = $value;
        $this->board = $board;
    }

    public function value()
    {
        return $this->value;
    }

    public function move($roll)
    {
        return $this->board->move($this, $roll);
    }
}