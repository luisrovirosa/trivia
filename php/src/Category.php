<?php

namespace Trivia;

class Category
{
    /** @var  string[] */
    private $questions;
    /** @var  string */
    private $name;

    /**
     * Category constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->questions = [];
        $this->name = $name;
    }

    public function addQuestion($question)
    {
        $this->questions[] = $question;
    }

    public function question()
    {
        $question = array_shift($this->questions);
        return $question;
    }

    public function name()
    {
        return $this->name;
    }
}