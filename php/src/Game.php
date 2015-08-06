<?php

namespace Trivia;

use Trivia\Output\Output;

class Game
{
    /** @var Players */
    private $players;

    /** @var Board */
    private $board;

    public function  __construct(Output $output)
    {
        $this->players = new Players();

        $this->board = new Board();

        $this->messages = new Messages($output);
    }

    public function addPlayer($playerName)
    {
        $player = new Player($playerName, $this->board->initialPosition());
        $this->players->add($player);

        $this->messages->newPlayer($player);
        $this->messages->numberOfPlayers($this->howManyPlayers());
        return $this;
    }

    public function roll($roll)
    {
        $player = $this->currentPlayer();
        $this->messages->isPlaying($player);
        $this->messages->rolls($roll);

        $player->gettingOutOfPenaltyBox($roll % 2 != 0);
        if ($player->isInPenaltyBox() && !$player->isGettingOutOfPenaltyBox()) {
            $this->messages->isNotGettingOutOfPenalty($player);
            return;
        }
        if ($player->isInPenaltyBox()) {
            $this->messages->isGettingOutOfPenalty($player);
        }
        $this->playTurn($roll);
    }

    public function wasCorrectlyAnswered()
    {
        $gameContinue = true;
        $isInPenaltyBox = $this->currentPlayer()->isInPenaltyBox();
        if (!$isInPenaltyBox || $this->currentPlayer()->isGettingOutOfPenaltyBox()) {
            $this->winPurse();
            $gameContinue = $this->didPlayerWin();
        }
        $this->nextPlayer();
        return $gameContinue;
    }

    public function wrongAnswer()
    {
        $this->messages->wrongAnswer($this->currentPlayer());
        $this->currentPlayer()->gotoPenaltyBox();

        $this->nextPlayer();
        return true;
    }

    private function didPlayerWin()
    {
        $currentPurses = $this->currentPlayer()->purses();
        return !($currentPurses == 6);
    }

    /**
     * @param $roll
     */
    private function movePlayer($roll)
    {
        $this->currentPlayer()->moveTo($roll);
    }

    private function winPurse()
    {
        $this->currentPlayer()->winPurse();
        $this->messages->winPurse($this->currentPlayer());
    }

    /**
     * @param $roll
     */
    private function playTurn($roll)
    {
        $this->movePlayer($roll);

        $this->messages->move($this->currentPlayer(), $this->currentCategory());
        $this->askQuestion();
    }

    /**
     * @return Player
     */
    private function currentPlayer()
    {
        return $this->players->current();
    }

    private function howManyPlayers()
    {
        return $this->players->number();
    }

    private function nextPlayer()
    {
        $this->players->next();
    }

    private function currentCategory()
    {
        return $this->currentPlayer()->position()->category()->name();
    }

    private function askQuestion()
    {
        $question = $this->board->questionFor($this->currentPlayer()->positionValue());
        $this->messages->question($question);

        return $question;
    }
}
