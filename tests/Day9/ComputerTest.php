<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day9;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use PHPUnit\Framework\TestCase;

class ComputerTest extends TestCase
{
    /**
     * @param int[] $memory
     *
     * @dataProvider provideTestSample
     */
    public function testSample(array $memory, string $expectedOutput): void
    {
        $memory = array_map('strval', $memory);
        $computer = new IntcodeComputer($memory);

        $output = $computer->resolve();

        $this->assertEquals($expectedOutput, $output);
    }

    public function provideTestSample(): \Generator
    {
        yield [
            [109, 1, 204, -1, 1001, 100, 1, 100, 1008, 100, 16, 101, 1006, 101, 0, 99],
            '1091204-1100110011001008100161011006101099',
        ];

        yield [
            [1102, 34915192, 34915192, 7, 4, 7, 99, 0],
            '1219070632396864',
        ];

        yield [
            [104, 1125899906842624, 99],
            '1125899906842624',
        ];
    }

    /**
     * @param int[] $memory
     *
     * @dataProvider provideTestAdjustRelativeBase
     */
    public function testAdjustRelativeBase(array $memory, int $initialRelativeBase, int $expextedRelativeBase)
    {
        $memory = array_map('strval', $memory);
        $computer = new IntcodeComputer($memory);
        $computer->relativeBase = $initialRelativeBase;

        $computer->resolve();

        $this->assertEquals($expextedRelativeBase, $computer->relativeBase);
    }

    public function provideTestAdjustRelativeBase(): \Generator
    {
        yield [
            [9, 0, 99],
            0,
            9
        ];

        yield [
            [109, 19, 99],
            0,
            19
        ];

        yield [
            [209, 3, 99, 15],
            0,
            15
        ];
    }

    public function testPart1()
    {
        $computer = new IntcodeComputer($this->getMemoryDump());
        $computer->setInput('1');
        $output = $computer->resolve();

        $this->assertNotEquals('0', $output);
        $this->assertNotEquals('2030', $output);
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

        return explode(',', $dump);
    }
}
