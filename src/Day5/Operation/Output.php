<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day5\Operation;

use Benji07\AdventOfCode\Day5\Computer;
use Benji07\AdventOfCode\Day5\Opcode;
use Benji07\AdventOfCode\Day5\Operation;

class Output extends Operation
{
    /** @var int */
    private int $parameter;

    public function __construct(Computer $computer, Opcode $opcode, int $parameter)
    {
        parent::__construct($computer, $opcode);

        $this->parameter = $parameter;
    }

    public function apply(): void
    {
        echo $this->getParameter();
    }

    protected function getParameter(): int
    {
        if ($this->opcode->mode[0] === Opcode::MODE_POSITION) {
            return $this->computer->get($this->parameter);
        }

        return $this->parameter;
    }
}
