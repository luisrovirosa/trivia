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

    /**
     * @param string $question
     */
    public function addQuestion($question)
    {
        $this->questions[] = $question;
    }

    /**
     * @return string
     */
    public function question()
    {
        $question = array_shift($this->questions);
        return $question;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}