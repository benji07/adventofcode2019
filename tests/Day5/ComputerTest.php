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
