<?php

namespace Trivia;

class Question
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var Category
     */
    private $category;

    /**
     * Question constructor.
     * @param string $text
     * @param Category $category
     */
    public function __construct($text, Category $category)
    {
        $this->text = $text;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->text;
    }
}