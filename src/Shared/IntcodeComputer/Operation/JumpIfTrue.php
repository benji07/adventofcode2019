<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class JumpIfTrue extends Operation
{
    public function apply(string &$output): void
    {
        if ($this->getParameter(0) !== '0') {
            $this->computer->memoryJump((int) $this->getParameter(1) - 1);
        }
    }
}
