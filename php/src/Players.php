<?php

namespace Trivia;

class Players
{
    /** @var  Player[] */
    private $players;

    private $currentPlayerIndex;

    /**
     * @var Position
     */
    private $initialPosition;

    /**
     * Players constructor.
     * @param Position $initialPosition
     */
    public function __construct(Position $initialPosition)
    {
        $this->players = [];
        $this->currentPlayerIndex = -1;
        $this->initialPosition = $initialPosition;
    }

    /**
     * @param string $playerName
     * @return Player
     */
    public function newPlayer($playerName)
    {
        $player = new Player($playerName, $this->initialPosition);
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
        if (!isset($this->players[$this->currentPlayerIndex])) {
            return NullPlayer::getInstance();
        }

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