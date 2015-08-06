<?php

namespace Trivia;

use Trivia\Output\Output;

class Game
{
    /** @var Players */
    private $players;

    /** @var Board */
    private $board;

    /** @var  Messages */
    private $messages;

    public function  __construct(Output $output)
    {
        $this->board = new Board();

        $this->players = new Players($this->board->initialPosition());

        $this->messages = new Messages($output);
    }

    public function addPlayer($playerName)
    {
        $player = $this->players->newPlayer($playerName);
        $this->messages->newPlayer($player, $this->howManyPlayers());

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
        $isInPenaltyBox = $this->currentPlayer()->isInPenaltyBox();
        if (!$isInPenaltyBox || $this->currentPlayer()->isGettingOutOfPenaltyBox()) {
            $this->winPurse();
        }
    }

    public function wrongAnswer()
    {
        $this->messages->wrongAnswer($this->currentPlayer());
        $this->currentPlayer()->gotoPenaltyBox();
    }

    public function isNotEnded()
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

        $this->messages->move($this->currentPlayer());
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

    public function nextPlayer()
    {
        $this->players->next();
    }

    private function askQuestion()
    {
        $question = $this->currentPlayer()->question();
        $this->messages->question($question);

        return $question;
    }
}
