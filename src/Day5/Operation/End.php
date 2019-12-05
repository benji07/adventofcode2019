<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day5\Operation;

use Benji07\AdventOfCode\Day5\Exception\EndOfProgramException;
use Benji07\AdventOfCode\Day5\Operation;

class End extends Operation
{
    /** @var int[] */
    private array $parameters;

    public function apply(): void
    {
        throw new EndOfProgramException();
    }
}
