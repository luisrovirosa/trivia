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

    private function write($string)
    {
        $this->output->write($string . "\n");
    }
}