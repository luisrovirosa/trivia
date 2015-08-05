<?php

namespace Trivia\Test;

use Trivia\Game;
use Trivia\Output\File;

class RegressionTest extends \PHPUnit_Framework_TestCase
{
    const OUTPUT_FILE = './test/current-play.log';
    const ORIGINAL_FILE = './test/play.log';
    const NUMBER_OR_GAMES = 10;

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
        srand(0);
        $output = new File($logFileName);
        $game = new Game($output);
        $runner = new \GameRunner($game);
        for ($i = 0; $i < self::NUMBER_OR_GAMES; $i++) {
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
        // In order to improve speed, first we check the filesize
        $this->assertHasSameFileSize();

        $this->assertHasSameContent();
    }

    protected function assertHasSameFileSize()
    {
        $this->assertEquals(filesize(self::ORIGINAL_FILE), filesize(self::OUTPUT_FILE));
    }

    protected function assertHasSameContent()
    {
        $output = file_get_contents(self::OUTPUT_FILE);

        $originalOutput = file_get_contents(self::ORIGINAL_FILE);
        $this->assertEquals($originalOutput, $output);
    }
}