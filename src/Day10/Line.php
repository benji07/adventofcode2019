<?php

namespace Benji07\AdventOfCode\Day10;

/**
 * Equation du type y = $ax + b
 */
class Line
{
    private int $a;

    private int $b;

    public function __construct(Point $point1, Point $point2)
    {
        $this->a = ($point2->x - $point1->x) ? ($point2->y - $point1->y)/($point2->x - $point1->x) : 0;
        $this->b = $point1->y - $this->a * $point1->x;
    }

    public function intersection(Point $point): bool
    {
        $y = $this->a * $point->x + $this->b;

        return ($y === $point->y);
    }
}
