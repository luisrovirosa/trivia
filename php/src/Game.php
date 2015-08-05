<?php

namespace Trivia;

class Game
{
    /** @var Player[] */
    private $players;

    /** @var Questions */
    private $questions;

    private $currentPlayer = 0;
    private $isGettingOutOfPenaltyBox;

    function  __construct()
    {

        $this->players = array();

        $this->prepareQuestions();
    }

    function isPlayable()
    {
        return ($this->howManyPlayers() >= 2);
    }

    function add($playerName)
    {
        $this->players[] = new Player($playerName);

        $this->echoln($playerName . " was added");
        $this->echoln("They are player number " . count($this->players));
        return true;
    }

    function howManyPlayers()
    {
        return count($this->players);
    }

    function  roll($roll)
    {
        $this->echoln($this->currentPlayerName() . " is the current player");
        $this->echoln("They have rolled a " . $roll);
        if ($this->currentPlayer()->isInPenaltyBox()) {
            $this->isGettingOutOfPenaltyBox = $roll % 2 != 0;

            if ($this->isGettingOutOfPenaltyBox) {
                $this->echoln(
                    $this->currentPlayerName() . " is getting out of the penalty box"
                );
                $this->playTurn($roll);
            } else {
                $this->echoln(
                    $this->currentPlayerName() .
                    " is not getting out of the penalty box"
                );
            }
        } else {
            $this->playTurn($roll);
        }
    }

    function  askQuestion()
    {
        $question = $this->questions->questionTextFor($this->currentPlayer()->position());
        $this->echoln($question);

        return $question;
    }

    function currentCategory()
    {
        return $this->questions->categoryNameFor($this->currentPlayer()->position());
    }

    function wasCorrectlyAnswered()
    {
        if ($this->currentPlayer()->isInPenaltyBox()) {
            if ($this->isGettingOutOfPenaltyBox) {
                $this->echoln("Answer was correct!!!!");
                $this->winPurse();
                $this->echoln(
                    $this->players[$this->currentPlayer]->name()
                    . " now has "
                    . $this->currentPlayer()->purses()
                    . " Gold Coins."
                );

                $winner = $this->didPlayerWin();
                $this->currentPlayer++;
                if ($this->currentPlayer == count($this->players)) {
                    $this->currentPlayer = 0;
                }

                return $winner;
            } else {
                $this->currentPlayer++;
                if ($this->currentPlayer == count($this->players)) {
                    $this->currentPlayer = 0;
                }
                return true;
            }
        } else {

            $this->echoln("Answer was corrent!!!!");
            $this->winPurse();
            $this->echoln(
                $this->players[$this->currentPlayer]->name()
                . " now has "
                . $this->currentPlayer()->purses()
                . " Gold Coins."
            );

            $winner = $this->didPlayerWin();
            $this->currentPlayer++;
            if ($this->currentPlayer == count($this->players)) {
                $this->currentPlayer = 0;
            }

            return $winner;
        }
    }

    function wrongAnswer()
    {
        $this->echoln("Question was incorrectly answered");
        $this->echoln(
            $this->players[$this->currentPlayer]->name() . " was sent to the penalty box"
        );
        $this->currentPlayer()->gotoPenaltyBox();

        $this->currentPlayer++;
        if ($this->currentPlayer == count($this->players)) {
            $this->currentPlayer = 0;
        }
        return true;
    }

    function didPlayerWin()
    {
        $currentPurses = $this->currentPlayer()->purses();
        return !($currentPurses == 6);
    }

    function echoln($string)
    {
        echo $string . "\n";
    }

    /**
     * @return string
     */
    protected function currentPlayerName()
    {
        return $this->currentPlayer()->name();
    }

    /**
     * @return Player
     */
    protected function currentPlayer()
    {
        return $this->players[$this->currentPlayer];
    }

    /**
     * @param $roll
     */
    protected function movePlayer($roll)
    {
        $nextPlace = ($this->currentPlayer()->position() + $roll) % 12;
        $this->currentPlayer()->moveTo($nextPlace);
    }

    protected function winPurse()
    {
        $this->currentPlayer()->winPurse();
    }

    /**
     * @param $roll
     */
    protected function playTurn($roll)
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

    protected function prepareQuestions()
    {
        $this->questions = new Questions();
    }

}
