<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Opcode;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class AdjustRelativeBase extends Operation
{
    public function __construct(IntcodeComputer $computer, Opcode $opcode, int $parameter)
    {
        parent::__construct($computer, $opcode, $parameter);
    }

    public function apply(string &$output): void
    {
        $this->computer->relativeBase += $this->getParameter(0);
    }
}
