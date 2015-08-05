<?php

namespace Trivia\Output;

class Console implements Output
{

    /**
     * @param string $message
     */
    public function write($message)
    {
        echo $message;
    }
}