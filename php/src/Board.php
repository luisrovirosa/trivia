<?php

namespace Trivia;

class Board
{

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
        return new Position(0, $this, $this->categoryFor(0));
    }

    public function move(Position $position, $roll)
    {
        $value = ($position->value() + $roll) % 12;
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
        for ($i = 0; $i < 50; $i++) {
            $question = new Question("$categoryName Question " . $i, $category);
            $category->addQuestion($question);
        }
    }
}