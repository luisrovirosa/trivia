<?php

namespace Trivia;

class Questions
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
            $this->categories[] = $this->createCategory($categoryName);
        }
    }

    /**
     * @param int $position
     * @return string
     */
    public function categoryNameFor($position)
    {
        return $this->categoryFor($position)->name();
    }

    /**
     * @param int $position
     * @return string
     */
    public function questionFor($position)
    {
        return $this->categoryFor($position)->question();
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
     * @param int $categoryName
     * @return Category
     */
    protected function createCategory($categoryName)
    {
        $category = new Category($categoryName);
        for ($i = 0; $i < 50; $i++) {
            $category->addQuestion("$categoryName Question " . $i);
        }
        return $category;
    }
}