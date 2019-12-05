<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day5;

use Benji07\AdventOfCode\Day5\Exception\EndOfProgramException;

class Computer
{
    /** @var int[] */
    private array $initialMemory;

    /** @var int[] */
    public array $memory;

    public int $input;

    private $index = 0;

    public function __construct(array $memory)
    {
        $this->initialMemory = $memory;
        $this->memory = $memory;
    }

    public function reset(): void
    {
        $this->index = 0;
        $this->memory = $this->initialMemory;
    }

    public function get(int $address): int
    {
        return $this->memory[$address];
    }

    public function getCurrent(): int
    {
        return $this->memory[$this->index];
    }

    public function getNext(): int
    {
        return $this->memory[++$this->index];
    }

    public function set(int $address, int $value): void
    {
        $this->memory[$address] = $value;
    }

    public function resolve(?int $noun = null, ?int $verb = null): void
    {
        $this->reset();

        if ($noun !== null) {
            $this->set(1, $noun);
        }

        if ($verb !== null) {
            $this->set(2, $verb);
        }

        reset($this->memory);
        do {
            try {
                $operation = Operation::create($this);
                $operation->apply();
            } catch (EndOfProgramException $exception) {
                return;
            }

            $this->getNext();
        } while (true);
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

    public function setInput(int $input): void
    {
        $this->input = $input;
    }

    public function memoryJump(int $index): void
    {
        $this->index = $index;
    }
}
