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
        $this->game->add("Chet");
        $this->game->add("Pat");
        $this->game->add("Sue");

        do {
            $this->game->roll(rand(0, 5) + 1);

            if (rand(0, 9) == 7) {
                $notAWinner = $this->game->wrongAnswer();
            } else {
                $notAWinner = $this->game->wasCorrectlyAnswered();
            }
        } while ($notAWinner);
    }
}


