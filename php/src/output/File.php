<?php

namespace Trivia\Output;

class File implements Output
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
        $this->logFileName = $logFileName;
        $this->file = fopen($this->logFileName, 'w');
    }

    function __destruct()
    {
        fclose($this->file);
    }

    /**
     * @param string $message
     */
    public function write($message)
    {
        fwrite($this->file, $message);
    }
}