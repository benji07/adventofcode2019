<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class Input extends Operation
{
    public function apply(string &$output): void
    {
        $input = $this->computer->getInput();

        $this->computer->set((int) $this->parameters[0], $input);
    }
}
