<?php

namespace Benji07\AdventOfCode\Day14;

class Chemical
{
    /** @var int */
    public int $quantity;

    /** @var string */
    public string $type;

    public function __construct(int $quantity, string $type)
    {
        $this->quantity = $quantity;
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->quantity . $this->type;
    }
}
