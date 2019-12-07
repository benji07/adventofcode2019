<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day7;

use Benji07\AdventOfCode\Day7\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    /**
     * @param int[] $memory
     * @param int[] $phaseSettings
     *
     * @dataProvider provideTestGetThrusterSignal
     */
    public function testGetThrusterSignal(array $memory, array $phaseSettings, int $expectedThrusterSignal): void
    {
        $program = new Program($memory);
        $thrusterSignal = $program->getThrusterSignal($phaseSettings);

        $this->assertEquals($expectedThrusterSignal, $thrusterSignal);
    }

    public function provideTestGetThrusterSignal(): \Generator
    {
        yield [
            [3, 15, 3, 16, 1002, 16, 10, 16, 1, 16, 15, 15, 4, 15, 99, 0, 0],
            [4, 3, 2, 1, 0],
            43210,
        ];

        yield [
            [3, 23, 3, 24, 1002, 24, 10, 24, 1002, 23, -1, 23, 101, 5, 23, 23, 1, 24, 23, 23, 4, 23, 99, 0, 0],
            [0, 1, 2, 3, 4],
            54321,
        ];

        yield [
            [3, 31, 3, 32, 1002, 32, 10, 32, 1001, 31, -2, 31, 1007, 31, 0, 33, 1002, 33, 7, 33, 1, 33, 31, 31, 1, 32, 31, 31, 4, 31, 99, 0, 0, 0],
            [1, 0, 4, 3, 2],
            65210,
        ];
    }

    public function testPart1()
    {
        $program = new Program($this->getMemoryDump());
        $thrusterSignal = $program->getMaxThrusterSignal();

        $this->assertEquals(70597, $thrusterSignal);
    }

    /**
     * @return int[]
     */
    private function getMemoryDump(): array
    {
        $dump = file_get_contents(__DIR__ . '/data/input.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return array_map('intval', explode(',', $dump));
    }
}
