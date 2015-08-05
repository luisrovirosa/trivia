<?php

namespace Trivia;

class Players
{
    /** @var  Player[] */
    private $players;

    private $currentPlayerIndex;

    /**
     * Players constructor.
     */
    public function __construct()
    {
        $this->players = [];
        $this->currentPlayerIndex = 0;
    }

    /**
     * @param Player $player
     * @return $this
     */
    public function add(Player $player)
    {
        $this->players[] = $player;
        return $this;
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