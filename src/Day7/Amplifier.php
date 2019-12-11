<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day7;

use Benji07\AdventOfCode\Shared\IntcodeComputer;

class Amplifier
{
    private IntcodeComputer $computer;

    public function __construct(IntcodeComputer $computer)
    {
        $this->computer = $computer;
    }

    /**
     * @param string[] $input
     */
    public function run(array $input): string
    {
        $this->computer->setInput($input);

        return $this->computer->resolve();
    }

    public function reset(): void
    {
        $this->computer->reset();
    }
}
