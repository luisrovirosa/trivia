<?php

namespace Trivia\Test;

use Trivia\Game;

class FakeGame extends Game
{
    private $file;
    /**
     * @var
     */
    private $logFileName;

    /**
     * FakeGame constructor.
     * @param $logFileName
     */
    public function __construct($logFileName)
    {
        parent::__construct();

        $this->logFileName = $logFileName;
        $this->file = fopen($this->logFileName, 'w');
        srand(0);
    }

    function echoln($string)
    {
        fwrite($this->file, $string . "\n");
    }

    function __destruct()
    {
        fclose($this->file);
    }

}