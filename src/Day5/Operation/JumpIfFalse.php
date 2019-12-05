<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day5\Operation;

use Benji07\AdventOfCode\Day5\Computer;
use Benji07\AdventOfCode\Day5\Opcode;
use Benji07\AdventOfCode\Day5\Operation;

class JumpIfFalse extends Operation
{
    /** @var int[] */
    private array $parameters;

    public function __construct(Computer $computer, Opcode $opcode, int ...$parameters)
    {
        parent::__construct($computer, $opcode);

        $this->parameters = $parameters;
    }

    public function apply(): void
    {
        if ($this->getParameter(0) === 0) {
            $this->computer->memoryJump($this->getParameter(1) - 1);
        }
    }

    public function getParameter(int $index): int
    {
        if ($this->opcode->mode[$index] === Opcode::MODE_POSITION) {
            return $this->computer->get($this->parameters[$index]);
        }

        return $this->parameters[$index];
    }
}
