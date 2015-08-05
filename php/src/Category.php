<?php

namespace Trivia;

class Category
{
    /** @var Question[] */
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
     * @param Question $question
     */
    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    /**
     * @return string
     */
    public function questionText()
    {
        /** @var Question $question */
        $question = array_shift($this->questions);
        return $question->text();
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}