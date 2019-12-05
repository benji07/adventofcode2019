<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day5\Operation;

use Benji07\AdventOfCode\Day5\Computer;
use Benji07\AdventOfCode\Day5\Opcode;
use Benji07\AdventOfCode\Day5\Operation;

class Input extends Operation
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
        $this->computer->set($this->getParameter(), $this->computer->input);
    }

    protected function getParameter(): int
    {
        return $this->parameter;
    }
}
