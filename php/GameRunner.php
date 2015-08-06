<?php

class GameRunner
{
    /**
     * @var \Trivia\Game
     */
    private $game;

    /**
     * GameRunner constructor.
     * @param \Trivia\Game $game
     */
    public function __construct(\Trivia\Game $game)
    {
        $this->game = $game;
    }

    public function run()
    {
        $this->setPlayers();
        $this->play();
    }

    protected function setPlayers()
    {
        $this->game
            ->addPlayer("Chet")
            ->addPlayer("Pat")
            ->addPlayer("Sue");
    }

    protected function play()
    {
        do {
            $this->game->nextPlayer();
            $this->game->roll(rand(0, 5) + 1);
            if ($this->isGoingToAnswerCorrectly()) {
                $this->game->wasCorrectlyAnswered();
            } else {
                $this->game->wrongAnswer();
            }
        } while ($this->game->isNotEnded());
    }

    /**
     * @return bool
     */
    protected function isGoingToAnswerCorrectly()
    {
        return rand(0, 9) != 7;
    }
}

