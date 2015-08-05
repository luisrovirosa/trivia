<?php

namespace Trivia;

class Questions
{
    /** @var string[] */
    private $popQuestions;
    /** @var string[] */
    private $scienceQuestions;
    /** @var string[] */
    private $sportsQuestions;
    /** @var string[] */
    private $rockQuestions;

    /**
     * Questions constructor.
     */
    public function __construct()
    {
        $this->popQuestions = [];
        $this->scienceQuestions = [];
        $this->sportsQuestions = [];
        $this->rockQuestions = [];

        for ($i = 0; $i < 50; $i++) {
            array_push($this->popQuestions, "Pop Question " . $i);
            array_push($this->scienceQuestions, ("Science Question " . $i));
            array_push($this->sportsQuestions, ("Sports Question " . $i));
            array_push($this->rockQuestions, "Rock Question " . $i);
        }
    }

    public function categoryFor($position)
    {
        $categories = [
            0 => 'Pop',
            1 => 'Science',
            2 => 'Sports',
            3 => 'Rock',
        ];
        $categoryType = $position % 4;
        return $categories[$categoryType];
    }

    public function questionFor($position)
    {
        if ($this->categoryFor($position) == "Pop") {
            return array_shift($this->popQuestions);
        }
        if ($this->categoryFor($position) == "Science") {
            return array_shift($this->scienceQuestions);
        }
        if ($this->categoryFor($position) == "Sports") {
            return array_shift($this->sportsQuestions);
        }
        if ($this->categoryFor($position) == "Rock") {
            return array_shift($this->rockQuestions);
        }
    }
}