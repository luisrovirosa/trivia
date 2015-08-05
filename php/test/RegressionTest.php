<?php

class RegressionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_the_same_output()
    {
        $runner = new GameRunner();
        $runner->run();
    }
}