<?php

namespace Benji07\AdventOfCode\Day10;

class Asteroid
{
    public Point $point;

    public function __construct(Point $point)
    {
        $this->point = $point;
    }
}
