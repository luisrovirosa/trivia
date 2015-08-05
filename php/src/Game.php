<?php

namespace Trivia;

class Game
{
    /** @var Player[] */
    private $players;

    private $inPenaltyBox;

    private $popQuestions;
    private $scienceQuestions;
    private $sportsQuestions;
    private $rockQuestions;

    private $currentPlayer = 0;
    private $isGettingOutOfPenaltyBox;

    function  __construct()
    {

        $this->players = array();
        $this->inPenaltyBox = array(0);

        $this->popQuestions = array();
        $this->scienceQuestions = array();
        $this->sportsQuestions = array();
        $this->rockQuestions = array();

        for ($i = 0; $i < 50; $i++) {
            array_push($this->popQuestions, "Pop Question " . $i);
            array_push($this->scienceQuestions, ("Science Question " . $i));
            array_push($this->sportsQuestions, ("Sports Question " . $i));
            array_push($this->rockQuestions, $this->createRockQuestion($i));
        }
    }

    function createRockQuestion($index)
    {
        return "Rock Question " . $index;
    }

    function isPlayable()
    {
        return ($this->howManyPlayers() >= 2);
    }

    function add($playerName)
    {
        $this->players[] = new Player($playerName);
        $this->inPenaltyBox[$this->howManyPlayers()] = false;

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
        if ($this->inPenaltyBox[$this->currentPlayer]) {
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
        if ($this->currentCategory() == "Pop") {
            $this->echoln(array_shift($this->popQuestions));
        }
        if ($this->currentCategory() == "Science") {
            $this->echoln(array_shift($this->scienceQuestions));
        }
        if ($this->currentCategory() == "Sports") {
            $this->echoln(array_shift($this->sportsQuestions));
        }
        if ($this->currentCategory() == "Rock") {
            $this->echoln(array_shift($this->rockQuestions));
        }
    }

    function currentCategory()
    {
        $currentPosition = $this->currentPlayer()->position();
        if ($currentPosition == 0) {
            return "Pop";
        }
        if ($currentPosition == 4) {
            return "Pop";
        }
        if ($currentPosition == 8) {
            return "Pop";
        }
        if ($currentPosition == 1) {
            return "Science";
        }
        if ($currentPosition == 5) {
            return "Science";
        }
        if ($currentPosition == 9) {
            return "Science";
        }
        if ($currentPosition == 2) {
            return "Sports";
        }
        if ($currentPosition == 6) {
            return "Sports";
        }
        if ($currentPosition == 10) {
            return "Sports";
        }
        return "Rock";
    }

    function wasCorrectlyAnswered()
    {
        if ($this->inPenaltyBox[$this->currentPlayer]) {
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
        $this->inPenaltyBox[$this->currentPlayer] = true;

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

}
