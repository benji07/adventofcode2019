<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day2;

class Computer
{
    /** @var int[] */
    private array $initialMemory;

    /** @var int[] */
    public array $memory;

    public function __construct(array $memory)
    {
        $this->initialMemory = $memory;
        $this->memory = $memory;
    }

    public function reset(): void
    {
        $this->memory = $this->initialMemory;
    }

    public function resolve(?int $noun = null, ?int $verb = null): void
    {
        $this->reset();

        if ($noun !== null) {
            $this->memory[1] = $noun;
        }

        if ($verb !== null) {
            $this->memory[2] = $verb;
        }

        $i = 0;
        do {
            @[$opcode, $a, $b, $result] = array_slice($this->memory, $i, 4);

            switch ($opcode) {
                case 1:
                    // addition
                    $this->memory[$result] = $this->memory[$a] + $this->memory[$b];
                    break;
                case 2:
                    // multiplication
                    $this->memory[$result] = $this->memory[$a] * $this->memory[$b];
                    break;
                case 99:
                    // stop
                    break;
            }
            $i += 4;
        } while ($opcode !== 99);
    }
}
