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
            $this->categories[] = $this->createCategoryQuestions($categoryName);
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
     * @return Question
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
    protected function createCategoryQuestions($categoryName)
    {
        $category = new Category($categoryName);
        $this->addQuestionsTo($category);
        return $category;
    }

    /**
     * @param Category $category
     */
    protected function addQuestionsTo(Category $category)
    {
        $categoryName = $category->name();
        for ($i = 0; $i < 50; $i++) {
            $question = new Question("$categoryName Question " . $i);
            $category->addQuestion($question);
        }
    }
}