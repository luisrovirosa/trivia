<?php

namespace Trivia;

use Trivia\Output\Output;

class Messages
{
    /**
     * @var Output
     */
    private $output;

    /**
     * Messages constructor.
     * @param Output $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * @param Player $player
     * @param $numberOfPlayers
     */
    public function newPlayer(Player $player, $numberOfPlayers)
    {
        $this->write($player->name() . " was added");
        $this->write("They are player number $numberOfPlayers");
    }

    /**
     * @param Player $player
     */
    public function isPlaying(Player $player)
    {
        $this->write($player->name() . " is the current player");
    }

    /**
     * @param int $roll
     */
    public function rolls($roll)
    {
        $this->write("They have rolled a $roll");
    }

    public function isGettingOutOfPenalty(Player $player)
    {
        $this->write($player->name() . " is getting out of the penalty box");
    }

    public function isNotGettingOutOfPenalty(Player $player)
    {
        $this->write($player->name() . " is not getting out of the penalty box");
    }

    public function question(Question $question)
    {
        $this->write($question->text());
    }

    public function winPurse(Player $player)
    {
        $this->write("Answer was correct!!!!");
        $this->write($player->name() . " now has " . $player->purses() . " Gold Coins.");
    }

    public function wrongAnswer(Player $player)
    {
        $this->write("Question was incorrectly answered");
        $this->write($player->name() . " was sent to the penalty box");
    }

    public function move(Player $player)
    {
        $this->write($player->name() . "'s new location is " . $player->positionValue());
        $this->write("The category is " . $player->position()->category());
    }

    private function write($string)
    {
        $this->output->write($string . "\n");
    }
}