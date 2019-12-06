<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Tests\Day6;

use Benji07\AdventOfCode\Day6\OrbitCounter;
use PHPUnit\Framework\TestCase;

class OrbitCounterTest extends TestCase
{
    public function testCount()
    {
        $input = [
            'COM)B',
            'B)C',
            'C)D',
            'D)E',
            'E)F',
            'B)G',
            'G)H',
            'D)I',
            'E)J',
            'J)K',
            'K)L',
        ];

        $orbitCounter = new OrbitCounter($input);

        $this->assertEquals(42, $orbitCounter->count());
    }

    public function testPart1(): void
    {
        $dump = $this->getData();

        $orbitCounter = new OrbitCounter($dump);

        $this->assertEquals(271151, $orbitCounter->count());
    }

    /**
     * @return string[]
     */
    protected function getData(): array
    {
        $dump = file(__DIR__ . '/data/input.txt');

        if ($dump === false) {
            $this->fail('Invalid file');

            return [];
        }

        return $dump;
    }
}
