<?php

namespace Trivia;

class Question
{
    /** @var string */
    private $text;

    /**
     * Question constructor.
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->text;
    }
}