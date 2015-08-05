<?php

namespace Trivia\Test;

class RegressionTest extends \PHPUnit_Framework_TestCase
{
    const OUTPUT_FILE = './test/current-play.log';
    const ORIGINAL_FILE = './test/play.log';

    /** @test */
    public function it_returns_the_same_output()
    {
        $this->ensureOriginalFileExists();

        $this->play(self::OUTPUT_FILE);

        $this->assertSameOutput();
    }

    /**
     * @param $logFileName
     */
    protected function play($logFileName)
    {
        $game = new FakeGame($logFileName);
        $runner = new \GameRunner($game);
        for ($i = 0; $i < 10; $i++) {
            $runner->run();
        }
    }

    protected function ensureOriginalFileExists()
    {
        if (!file_exists(self::ORIGINAL_FILE)) {
            $this->play(self::ORIGINAL_FILE);
        }
    }

    protected function assertSameOutput()
    {
        $output = file_get_contents(self::OUTPUT_FILE);

        $originalOutput = file_get_contents(self::ORIGINAL_FILE);
        $this->assertEquals($originalOutput, $output);
    }
}