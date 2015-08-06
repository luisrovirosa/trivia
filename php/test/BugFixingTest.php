<?php

namespace Trivia\Test;

use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTestCase;
use Trivia\Game;

class BugFixingTest extends ProphecyTestCase
{
    /** @test */
    public function if_it_remains_in_penalty_box_does_not_answer()
    {
        $this->markTestSkipped('Not yet');
        $gameProphecy = $this->prophesize('Trivia\Game');
        /** @var Game $game */
        $game = $gameProphecy->reveal();

        $gameProphecy->addPlayer(Argument::any())->willReturn($game);
        $gameProphecy->roll(Argument::any())->willReturn(false);
        $runner = new \GameRunner($game);

        $runner->run();

        $gameProphecy->wrongAnswer()->shouldNotBeCalled();
        $gameProphecy->wasCorrectlyAnswered()->shouldNotBeCalled();
    }
}