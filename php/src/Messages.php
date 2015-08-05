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
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function newPlayer(Player $player)
    {
        $this->write($player->name() . " was added");
    }

    public function numberOfPlayers($numberOfPlayers)
    {
        $this->write("They are player number $numberOfPlayers");
    }

    private function write($string)
    {
        $this->output->write($string . "\n");
    }

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
}