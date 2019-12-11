<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Shared;

use Benji07\AdventOfCode\Shared\IntcodeComputer\EndOfProgramException;
use Benji07\AdventOfCode\Shared\IntcodeComputer\Operation;

class IntcodeComputer
{
    /** @var string[] */
    private array $initialMemory;

    /** @var string[] */
    public array $memory;

    /** @var string[] */
    public array $input;

    private bool $throwException;

    private bool $breakOnOutput;

    public int $index;

    public int $relativeBase;

    public function __construct(array $memory, bool $throwException = false, bool $breakOnOutput = false)
    {
        $this->initialMemory = $memory;
        $this->memory = $memory;
        $this->throwException = $throwException;
        $this->breakOnOutput = $breakOnOutput;
        $this->index = 0;
        $this->relativeBase = 0;
    }

    public function reset(): void
    {
        $this->index = 0;
        $this->memory = $this->initialMemory;
    }

    public function get(int $address): string
    {
        return $this->memory[$address] ?? '0';
    }

    public function getCurrent(): string
    {
        return $this->memory[$this->index] ?? '0';
    }

    public function getNext(): string
    {
        return $this->memory[++$this->index] ?? '0';
    }

    public function set(int $address, string $value): void
    {
        $this->memory[$address] = $value;
    }

    public function resolve(?string $noun = null, ?string $verb = null): string
    {
        $output = '';

        if ($noun !== null) {
            $this->set(1, $noun);
        }

        if ($verb !== null) {
            $this->set(2, $verb);
        }

        try {
            do {
                $index = $this->index;
                $operation = Operation::create($this);
                var_dump([
                    'index' => $index,
                    'relativeBase' => $this->relativeBase,
                    'class' => get_class($operation),
                    'opcode' => (string) $operation->opcode,
                    'parameters' => $operation->parameters,
                    'input' => $this->input
                ]);
                $operation->apply($output);

                $this->getNext();

                if ($operation instanceof Operation\Output && $this->breakOnOutput) {
                    return $output;
                }
            } while (true);
        } catch (EndOfProgramException $exception) {
            if ($this->throwException) {
                throw $exception;
            }
        }

        return $output;
    }

    /**
     * @return string[] [$noun, $verb]
     */
    public function findInput(string $output): array
    {
        for ($noun = 0; $noun <= 99; ++$noun) {
            for ($verb = 0; $verb <= 99; ++$verb) {
                $this->reset();
                $this->resolve((string) $noun, (string) $verb);

                if ($this->memory[0] === $output) {
                    return [$noun, $verb];
                }
            }
        }
    }

    /**
     * @param string|string[] $input
     */
    public function setInput($input): void
    {
        $this->input = is_array($input) ? $input : [$input];
    }

    public function getInput(): string
    {
        return array_shift($this->input) ?? '0';
    }

    public function memoryJump(int $index): void
    {
        $this->index = $index;
    }
}
