<?php

namespace Trivia\Output;

interface Output
{
    /**
     * @param string $message
     */
    public function write($message);
}