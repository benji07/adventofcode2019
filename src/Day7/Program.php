<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day7;

use Benji07\AdventOfCode\Shared\IntcodeComputer;
use Brick\Math\BigInteger;

class Program
{
    /** @var Amplifier[] */
    private array $amplifiers;

    private bool $loopFeedBack;

    /**
     * @param string[] $memory
     */
    public function __construct(array $memory, bool $loopFeedBack = false)
    {
        $this->amplifiers = [
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
            new Amplifier(new IntcodeComputer($memory, $loopFeedBack, $loopFeedBack)),
        ];
        $this->loopFeedBack = $loopFeedBack;
    }

    /**
     * @param int[] $phaseSequence
     */
    public function getThrusterSignal(array $phaseSequence): string
    {
        $previous = $output = 0;
        $phaseSequence = array_map('strval', $phaseSequence);
        try {
            while (true) {
                foreach ($this->amplifiers as $i => $amplifier) {
                    //var_dump('amplifier-'.$i);
                    $defaultInput = array_shift($phaseSequence);
                    $input = [];

                    if ($defaultInput !== null) {
                        $input[] = $defaultInput;
                    }

                    $input[] = $output;
                    //var_dump('input = ' . implode(', ', $input));
                    $previous = $output = $amplifier->run(array_map('strval', $input));
                    //var_dump('output = ' . $output);
                }

                if ($this->loopFeedBack === false) {
                    return $output;
                }
            }

            return $output;
        } catch (IntcodeComputer\EndOfProgramException $exception) {
            //var_dump($exception, $exception->getOutput());
            return $previous;
        }
    }

    public function getMaxThrusterSignal(int $min = 0, int $max = 4): string
    {
        $maxSignal = BigInteger::of(0);

        foreach ($this->getPossiblePhaseSequence($min, $max) as $phaseSequence) {
            $this->resetComputer();
            $maxSignal = BigInteger::max($maxSignal, BigInteger::of($this->getThrusterSignal($phaseSequence)));
        }

        return (string) $maxSignal;
    }

    protected function getPossiblePhaseSequence(int $min, int $max): iterable
    {
        $phaseSequence = [];
        for ($i = $min; $i <= $max; ++$i) {
            $phaseSequence[0] = $i;
            for ($j = $min; $j <= $max; ++$j) {
                $phaseSequence[1] = $j;
                for ($k = $min; $k <= $max; ++$k) {
                    $phaseSequence[2] = $k;
                    for ($l = $min; $l <= $max; ++$l) {
                        $phaseSequence[3] = $l;
                        for ($m = $min; $m <= $max; ++$m) {
                            $phaseSequence[4] = $m;
                            if (count(array_unique($phaseSequence)) < count($this->amplifiers)) {
                                continue;
                            }

                            yield $phaseSequence;
                        }
                    }
                }
            }
        }

        return;
    }

    private function resetComputer()
    {
        foreach ($this->amplifiers as $amplifier) {
            $amplifier->reset();
        }
    }
}
