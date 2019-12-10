<?php

namespace Benji07\AdventOfCode\Day10;

class Point
{
    public int $x;

    public int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function __toString(): string
    {
        return "({$this->x};{$this->y}";
    }
}
