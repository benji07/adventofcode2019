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

    /**
     * @return int[] [$noun, $verb]
     */
    public function findInput(int $output): array
    {
        for ($noun = 0; $noun <= 99; ++$noun) {
            for ($verb = 0; $verb <= 99; ++$verb) {
                $this->resolve($noun, $verb);

                if ($this->memory[0] === $output) {
                    return [$noun, $verb];
                }
            }
        }
    }
}
