<?php

namespace Trivia;

class NullPlayer extends Player
{
    private static $instance;

    /**
     * NullPlayer constructor.
     */
    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new NullPlayer();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function name()
    {
        return '';
    }

    /**
     * @return Position
     */
    public function position()
    {
        return null;
    }

    /**
     * @return int
     */
    public function positionValue()
    {
        return 0;
    }

    /**
     * @param $roll
     */
    public function move($roll)
    {
    }

    /**
     *
     */
    public function winPurse()
    {
    }

    /**
     * @return int
     */
    public function purses()
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function isInPenaltyBox()
    {
        return false;
    }

    public function gotoPenaltyBox()
    {
    }

    /**
     * @param boolean $gettingOut
     */
    public function gettingOutOfPenaltyBox($gettingOut)
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isGettingOutOfPenaltyBox()
    {
        return false;
    }

    public function question()
    {
        return null;
    }

}