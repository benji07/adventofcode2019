<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;
use Brick\Math\BigInteger;

class Multiply extends Operation
{
    public function apply(string &$output): void
    {
        $this->computer->set(
            (int) $this->parameters[2],
            (string) BigInteger::of($this->getParameter(0))->multipliedBy(BigInteger::of($this->getParameter(1)))
        );
    }
}
