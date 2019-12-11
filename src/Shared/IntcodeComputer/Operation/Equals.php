<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class Equals extends Operation
{
    public function apply(string &$output): void
    {
        $this->computer->set(
            (int) $this->parameters[2],
            $this->getParameter(0) === $this->getParameter(1) ? '1' : '0'
        );
    }
}
