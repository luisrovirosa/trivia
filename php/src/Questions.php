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

    public function categoryNameFor($position)
    {
        return $this->categoryFor($position)->name();
    }

    public function questionFor($position)
    {
        return $this->categoryFor($position)->question();
    }

    /**
     * @param $position
     * @return Category
     */
    protected function categoryFor($position)
    {
        return $this->categories[$position % 4];
    }

    /**
     * @param $categoryName
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