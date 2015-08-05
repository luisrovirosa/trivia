<?php

namespace Trivia;

interface Output
{
    /**
     * @param string $message
     */
    public function write($message);
}