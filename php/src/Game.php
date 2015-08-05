<?php

namespace Trivia;

use Trivia\Output\Output;

class Game
{
    /** @var Player[] */
    private $players;

    /** @var int */
    private $currentPlayerIndex = 0;

    /** @var Questions */
    private $questions;

    /** @var Output */
    private $output;

    public function  __construct(Output $output)
    {
        $this->players = array();

        $this->prepareQuestions();

        $this->output = $output;

        $this->messages = new Messages($output);
    }

    public function add($playerName)
    {
        $player = new Player($playerName);
        $this->players[] = $player;

        $this->messages->newPlayer($player);
        $this->messages->numberOfPlayers($this->howManyPlayers());
    }

    private function howManyPlayers()
    {
        return count($this->players);
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

    private function askQuestion()
    {
        $question = $this->questions->questionFor($this->currentPlayer()->position());
        $this->messages->question($question);

        return $question;
    }

    private function currentCategory()
    {
        return $this->questions->categoryNameFor($this->currentPlayer()->position());
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
     * @return Player
     */
    private function currentPlayer()
    {
        return $this->players[$this->currentPlayerIndex];
    }

    /**
     * @param $roll
     */
    private function movePlayer($roll)
    {
        $nextPlace = ($this->currentPlayer()->position() + $roll) % 12;
        $this->currentPlayer()->moveTo($nextPlace);
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

    private function prepareQuestions()
    {
        $this->questions = new Questions();
    }

    private function nextPlayer()
    {
        $this->currentPlayerIndex = ($this->currentPlayerIndex + 1) % $this->howManyPlayers();
    }
}
