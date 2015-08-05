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
        $popCategory = new Category('Pop');
        $scienceCategory = new Category('Science');
        $sportsCategory = new Category('Sports');
        $rockCategory = new Category('Rock');

        $this->categories = [
            $popCategory,
            $scienceCategory,
            $sportsCategory,
            $rockCategory
        ];

        for ($i = 0; $i < 50; $i++) {
            $popCategory->addQuestion("Pop Question " . $i);
            $scienceCategory->addQuestion("Science Question " . $i);
            $sportsCategory->addQuestion("Sports Question " . $i);
            $rockCategory->addQuestion("Rock Question " . $i);
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
}