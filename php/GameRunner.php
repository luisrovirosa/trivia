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
            $this->game->roll(rand(0, 5) + 1);
            if ($this->isCorrectAnswer()) {
                $notAWinner = $this->game->wasCorrectlyAnswered();
            } else {
                $notAWinner = $this->game->wrongAnswer();
            }
            $this->game->nextPlayer();
        } while ($notAWinner);
    }

    /**
     * @return bool
     */
    protected function isCorrectAnswer()
    {
        return rand(0, 9) != 7;
    }
}

