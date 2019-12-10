<?php

namespace Benji07\AdventOfCode\Day10;

class MonitoringSystem
{
    /** @var Asteroid[] */
    private array $asteroids;

    public function __construct(string $map)
    {
        $this->asteroids = [];

        $lines = explode("\n", $map);
        foreach ($lines as $y => $line) {
            $cells = str_split(trim($line));
            foreach ($cells as $x => $cell) {
                $point = new Point($x, $y);

                if ($cell === '#') {
                    $this->asteroids[] = new Asteroid($point);
                }
            }
        }
    }

    /**
     * @return Asteroid[]
     */
    public function getAsteroids(): array
    {
        return $this->asteroids;
    }

    public function countAsteroidInSight(Point $point): int
    {
        $nb = 0;

        foreach ($this->asteroids as $asteroid) {
            if ($asteroid->point == $point) {
                continue;
            }

            $a = new Line($point, $asteroid->point);
            var_dump(['a' => $point, 'b' => $asteroid->point]);
            foreach ($this->asteroids as $other) {
                if ($asteroid->point === $point) {
                    continue;
                }

                if ($asteroid->point === $other->point) {
                    continue;
                }

                $b = new Line($point, $other->point);

                if ($a->intersection($other->point)) {
                    $nb++;
                }
            }
        }

        return $nb;
    }
}
