<?php

namespace Benji07\AdventOfCode\Day8;

class Layer
{
    /** @var string[] */
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function countChar(string $char): int
    {
        return count_chars(implode('', $this->data))[ord($char)];
    }
}
