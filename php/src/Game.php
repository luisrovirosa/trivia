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

    private $isGettingOutOfPenaltyBox;

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
        $this->messages->isPlaying($this->currentPlayer());
        $this->messages->rolls($roll);
        if ($this->currentPlayer()->isInPenaltyBox()) {
            $this->isGettingOutOfPenaltyBox = $roll % 2 != 0;

            if ($this->isGettingOutOfPenaltyBox) {
                $this->messages->isGettingOutOfPenalty($this->currentPlayer());
                $this->playTurn($roll);
            } else {
                $this->messages->isNotGettingOutOfPenalty($this->currentPlayer());
            }
        } else {
            $this->playTurn($roll);
        }
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
        if ($this->currentPlayer()->isInPenaltyBox()) {
            if ($this->isGettingOutOfPenaltyBox) {
                $this->winPurse();
                $winner = $this->didPlayerWin();
            } else {
                $winner = true;
            }
        } else {
            $this->winPurse();
            $winner = $this->didPlayerWin();
        }
        $this->nextPlayer();
        return $winner;
    }

    public function wrongAnswer()
    {
        $this->echoln("Question was incorrectly answered");
        $this->echoln(
            $this->players[$this->currentPlayerIndex]->name() . " was sent to the penalty box"
        );
        $this->currentPlayer()->gotoPenaltyBox();

        $this->nextPlayer();
        return true;
    }

    private function didPlayerWin()
    {
        $currentPurses = $this->currentPlayer()->purses();
        return !($currentPurses == 6);
    }

    private function echoln($string)
    {
        $this->output->write($string . "\n");
    }

    /**
     * @return string
     */
    private function currentPlayerName()
    {
        return $this->currentPlayer()->name();
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

        $this->echoln(
            $this->currentPlayerName()
            . "'s new location is "
            . $this->currentPlayer()->position()
        );
        $this->echoln("The category is " . $this->currentCategory());
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
