<?php

namespace Trivia\Test;

class FakeGame extends \Game
{
    private $file;
    /**
     * @var
     */
    private $logFileName;

    /**
     * FakeGame constructor.
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