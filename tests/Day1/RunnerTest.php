<?php

namespace Benji07\AdventOfCode\Tests\Day1;

use Benji07\AdventOfCode\Day1\FuelCalculator;
use Benji07\AdventOfCode\Day1\Runner;
use PHPUnit\Framework\TestCase;

class RunnerTest extends TestCase
{
    public function testSampleRun()
    {
        $masses = file(__DIR__.'/data/sample.txt');

        $fuel = (new Runner(new FuelCalculator()))->run($masses);

        $this->assertEquals(106_795, $fuel);
    }

    public function testRun()
    {
        $masses = file(__DIR__.'/data/input.txt');

        $fuel = (new Runner(new FuelCalculator()))->run($masses);

        $this->assertEquals(3_412_531, $fuel);
    }
}
