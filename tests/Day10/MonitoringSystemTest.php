<?php

namespace Benji07\AdventOfCode\Tests\Day10;

use Benji07\AdventOfCode\Day10\Asteroid;
use Benji07\AdventOfCode\Day10\MonitoringSystem;
use Benji07\AdventOfCode\Day10\Point;
use Benji07\AdventOfCode\Day10\Line;
use PHPUnit\Framework\TestCase;

class MonitoringSystemTest extends TestCase
{
    public function testParseMap(): void
    {
        $system = new MonitoringSystem(
            '.#..#
             .....
             #####
             ....#
             ...##'
        );

        $this->assertCount(10, $system->getAsteroids());

        $this->assertEquals([
            new Asteroid(new Point(1, 0)),
            new Asteroid(new Point(4, 0)),
            new Asteroid(new Point(0, 2)),
            new Asteroid(new Point(1, 2)),
            new Asteroid(new Point(2, 2)),
            new Asteroid(new Point(3, 2)),
            new Asteroid(new Point(4, 2)),
            new Asteroid(new Point(4, 3)),
            new Asteroid(new Point(3, 4)),
            new Asteroid(new Point(4, 4)),
        ], $system->getAsteroids());
    }

    /**
     * @dataProvider provideTestCountAsteroidInSight
     */
    public function testCountAsteroidInSight(string $map, Point $point, int $expectedValue): void
    {
        $system = new MonitoringSystem($map);
        $this->assertEquals($expectedValue, $system->countAsteroidInSight($point));
    }

    public function provideTestCountAsteroidInSight(): \Generator
    {
        $map = '###';

        yield [$map, new Point(0, 0), 1,];
        yield [$map, new Point(1, 0), 2,];
        yield [$map, new Point(2, 2), 1,];

        $map = '.#..#
                .....
                #####
                ....#
                ...##';

        yield [$map, new Point(1, 0), 7,];
        yield [$map, new Point(4, 0), 7,];
        yield [$map, new Point(0, 2), 6,];
        yield [$map, new Point(1, 2), 7,];
        yield [$map, new Point(2, 2), 7,];
        yield [$map, new Point(3, 2), 7,];
        yield [$map, new Point(4, 2), 5,];
        yield [$map, new Point(4, 3), 7,];
        yield [$map, new Point(3, 4), 8,];
        yield [$map, new Point(4, 4), 7];
    }

    public function testVector()
    {
        $a = new Line(new Point(0, 0), new Point(1, 0));
        $b = new Line(new Point(0, 0), new Point(2, 0));

        $this->assertEquals(0, $a->delta($b));
        $this->assertEquals(0, $b->delta($a));

        $a = new Line(new Point(0, 0), new Point(1, 0));
        $b = new Line(new Point(0, 0), new Point(1, 1));

        $this->assertNotEquals(0, $a->delta($b));
        $this->assertNotEquals(0, $b->delta($a));
    }
}
