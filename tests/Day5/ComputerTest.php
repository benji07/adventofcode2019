<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day5;

use Benji07\AdventOfCode\Day5\Computer;
use PHPUnit\Framework\TestCase;

class ComputerTest extends TestCase
{
    /**
     * @param int[] $input
     * @param int[] $expectedOutput
     *
     * @dataProvider provideTestResolve
     */
    public function testResolve(array $input, array $expectedOutput): void
    {
        $computer = new Computer($input);
        $computer->resolve();

        $this->assertEquals(implode(',', $expectedOutput), implode(',', $computer->memory));
    }

    public function provideTestResolve()
    {
        yield [
            [1, 0, 0, 0, 99],
            [2, 0, 0, 0, 99],
        ];

        yield [
            [2, 3, 0, 3, 99],
            [2, 3, 0, 6, 99],
        ];

        yield [
            [2, 4, 4, 5, 99, 0],
            [2, 4, 4, 5, 99, 9801],
        ];

        yield [
            [1, 1, 1, 4, 99, 5, 6, 0, 99],
            [30, 1, 1, 4, 2, 5, 6, 0, 99],
        ];
    }

    public function testDay2Part1(): void
    {
        $memory = $this->getMemoryDumpDay2();

        $computer = new Computer($memory);

        $noun = 12;
        $verb = 2;

        $computer->resolve($noun, $verb);

        $this->assertEquals(3_409_710, $computer->memory[0]);
    }

    public function testFindInput(): void
    {
        $memory = $this->getMemoryDumpDay2();

        $computer = new Computer($memory);
        [$noun, $verb] = $computer->findInput(3_409_710);

        $this->assertEquals(12, $noun);
        $this->assertEquals(2, $verb);
    }

    public function testDay2Part2(): void
    {
        $memory = $this->getMemoryDumpDay2();

        $computer = new Computer($memory);
        [$noun, $verb] = $computer->findInput(19_690_720);

        $this->assertEquals(79, $noun);
        $this->assertEquals(12, $verb);

        $this->assertEquals(7912, $noun * 100 + $verb);
    }

    public function testMultiplyImmediate()
    {
        $computer = new Computer([1002, 4, 3, 4, 33]);
        $computer->resolve();

        $this->assertEquals([1002, 4, 3, 4, 99], $computer->memory);
    }

    public function testNegative()
    {
        $computer = new Computer([1101, 100, -1, 4, 0]);
        $computer->resolve();

        $this->assertEquals([1101, 100, -1, 4, 99], $computer->memory);
    }

    public function testSet()
    {
        $computer = new Computer([
            3, 7, 1, 7, 6, 6, 1100, 0, 1, 3, 99,
        ]);

        $computer->setInput(1);

        $computer->resolve();

        $this->assertEquals([3, 7, 1, 2, 6, 6, 1101, 1, 1, 3, 99], $computer->memory);
    }

    public function testPart1()
    {
        $memory = $this->getMemoryDumpDay5();

        $computer = new Computer($memory);
        $computer->setInput(1);

        ob_start();
        $computer->resolve();
        $result = ob_get_clean();

        $this->assertEquals('00000000016434972', $result);
    }

    /**
     * @dataProvider provideTestJump
     */
    public function testJump(array $memory, int $input, string $expectedOutput): void
    {
        $computer = new Computer($memory);
        $computer->setInput($input);

        ob_start();
        $computer->resolve();
        $result = ob_get_clean();

        $this->assertEquals($expectedOutput, $result);
    }

    public function provideTestJump(): \Generator
    {
        yield [
            [3, 9, 8, 9, 10, 9, 4, 9, 99, -1, 8],
            8,
            '1',
        ];

        yield [
            [3, 9, 8, 9, 10, 9, 4, 9, 99, -1, 8],
            2,
            '0',
        ];

        yield [
            [3, 9, 7, 9, 10, 9, 4, 9, 99, -1, 8],
            7,
            '1',
        ];

        yield [
            [3, 9, 7, 9, 10, 9, 4, 9, 99, -1, 8],
            9,
            '0',
        ];

        yield [
            [3, 3, 1108, -1, 8, 3, 4, 3, 99],
            8,
            '1',
        ];

        yield [
            [3, 3, 1108, -1, 8, 3, 4, 3, 99],
            2,
            '0',
        ];

        yield [
            [3, 3, 1107, -1, 8, 3, 4, 3, 99],
            2,
            '1',
        ];

        yield [
            [3, 3, 1107, -1, 8, 3, 4, 3, 99],
            8,
            '0',
        ];

        yield [
            [3, 12, 6, 12, 15, 1, 13, 14, 13, 4, 13, 99, -1, 0, 1, 9],
            0,
            '0',
        ];

        yield [
            [3, 12, 6, 12, 15, 1, 13, 14, 13, 4, 13, 99, -1, 0, 1, 9],
            2,
            '1',
        ];

        yield [
            [3, 3, 1105, -1, 9, 1101, 0, 0, 12, 4, 12, 99, 1],
            0,
            '0',
        ];

        yield [
            [3, 3, 1105, -1, 9, 1101, 0, 0, 12, 4, 12, 99, 1],
            2,
            '1',
        ];

        yield [
            [
                3, 21, 1008, 21, 8, 20, 1005, 20, 22, 107, 8, 21, 20, 1006, 20, 31, 1106,
                0, 36, 98, 0, 0, 1002, 21, 125, 20, 4, 20, 1105, 1, 46, 104, 999, 1105, 1,
                46, 1101, 1000, 1, 20, 4, 20, 1105, 1, 46, 98, 99,
            ],
            7,
            '999',
        ];

        yield [
            [
                3, 21, 1008, 21, 8, 20, 1005, 20, 22, 107, 8, 21, 20, 1006, 20, 31, 1106,
                0, 36, 98, 0, 0, 1002, 21, 125, 20, 4, 20, 1105, 1, 46, 104, 999, 1105, 1,
                46, 1101, 1000, 1, 20, 4, 20, 1105, 1, 46, 98, 99,
            ],
            8,
            '1000',
        ];

        yield [
            [
                3, 21, 1008, 21, 8, 20, 1005, 20, 22, 107, 8, 21, 20, 1006, 20, 31, 1106,
                0, 36, 98, 0, 0, 1002, 21, 125, 20, 4, 20, 1105, 1, 46, 104, 999, 1105, 1,
                46, 1101, 1000, 1, 20, 4, 20, 1105, 1, 46, 98, 99,
            ],
            9,
            '1001',
        ];
    }

    public function testPart2()
    {
        $memory = $this->getMemoryDumpDay5();

        $computer = new Computer($memory);
        $computer->setInput(5);

        ob_start();
        $computer->resolve();
        $result = ob_get_clean();

        $this->assertEquals('16694270', $result);
    }

    /**
     * @return int[]
     */
    private function getMemoryDumpDay2(): array
    {
        $dump = file_get_contents(__DIR__ . '/data/input.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return array_map('intval', explode(',', $dump));
    }

    /**
     * @return int[]
     */
    private function getMemoryDumpDay5(): array
    {
        $dump = file_get_contents(__DIR__ . '/data/input-day5.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return array_map('intval', explode(',', $dump));
    }
}
