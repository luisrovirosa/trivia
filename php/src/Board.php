<?php

namespace Trivia;

class Board
{
    const BOARD_SIZE = 12;
    const NUMBER_OF_QUESTIONS_PER_CATEGORY = 50;
    const FIRST_POSITION = 0;

    /** @var  Category[] */
    private $categories;

    /**
     * Questions constructor.
     */
    public function __construct()
    {
        $categories = ['Pop', 'Science', 'Sports', 'Rock'];
        foreach ($categories as $categoryName) {
            $category = new Category($categoryName);
            $this->addQuestionsTo($category);
            $this->categories[] = $category;
        }
    }

    public function initialPosition()
    {
        return new Position(self::FIRST_POSITION, $this, $this->categoryFor(self::FIRST_POSITION));
    }

    public function move(Position $position, $roll)
    {
        $value = ($position->value() + $roll) % self::BOARD_SIZE;

        return new Position($value, $this, $this->categoryFor($value));
    }

    /**
     * @param int $position
     * @return Category
     */
    protected function categoryFor($position)
    {
        return $this->categories[$position % 4];
    }

    /**
     * @param Category $category
     */
    protected function addQuestionsTo(Category $category)
    {
        $categoryName = $category->name();
        for ($i = 0; $i < self::NUMBER_OF_QUESTIONS_PER_CATEGORY; $i++) {
            $question = new Question("$categoryName Question " . $i);
            $category->addQuestion($question);
        }
    }
}