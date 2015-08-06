<?php

namespace Trivia;

class Position
{
    /**
     * @var int
     */
    private $value;
    /**
     * @var Board
     */
    private $board;
    /**
     * @var Category
     */
    private $category;

    /**
     * Position constructor.
     * @param int $value
     * @param Board $board
     * @param Category $category
     */
    public function __construct($value, Board $board, Category $category)
    {
        $this->value = $value;
        $this->board = $board;
        $this->category = $category;
    }

    public function value()
    {
        return $this->value;
    }

    public function move($roll)
    {
        return $this->board->move($this, $roll);
    }

    /**
     * @return Category
     */
    public function category()
    {
        return $this->category;
    }

    public function question()
    {
        return $this->category->question();
    }
}