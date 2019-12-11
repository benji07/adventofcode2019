<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared\IntcodeComputer;

class EndOfProgramException extends \DomainException
{
    private string $output;

    public function __construct(string $output)
    {
        parent::__construct('end of program');

        $this->output = $output;
    }

    public function getOutput(): string
    {
        return $this->output;
    }
}
