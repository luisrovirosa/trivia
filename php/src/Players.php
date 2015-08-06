<?php

namespace Trivia;

class Players
{
    /** @var  Player[] */
    private $players;

    private $currentPlayerIndex;
    /**
     * @var Board
     */
    private $board;

    /**
     * Players constructor.
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->players = [];
        $this->currentPlayerIndex = -1;
        $this->board = $board;
    }

    /**
     * @param string $playerName
     * @return Player
     */
    public function newPlayer($playerName)
    {
        $player = new Player($playerName, $this->board->initialPosition());
        $this->players[] = $player;

        return $player;
    }

    /**
     * @return int
     */
    public function number()
    {
        return count($this->players);
    }

    /**
     * @return Player
     */
    public function current()
    {
        return $this->players[$this->currentPlayerIndex];
    }

    /**
     *
     */
    public function next()
    {
        $this->currentPlayerIndex = ($this->currentPlayerIndex + 1) % $this->number();
    }
}