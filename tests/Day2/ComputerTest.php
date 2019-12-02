<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day2;

use Benji07\AdventOfCode\Day2\Computer;
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

    public function testPart1(): void
    {
        $input = array_map('intval', explode(',', file_get_contents(__DIR__.'/data/input.txt')));

        $noun = 12;
        $verb = 2;

        $computer = new Computer($input);
        $computer->resolve($noun, $verb);

        $this->assertEquals(3409710, $computer->memory[0]);
    }
}
