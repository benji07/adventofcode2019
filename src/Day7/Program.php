<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day7;

use Benji07\AdventOfCode\Shared\IntcodeComputer;

class Program
{
    /** @var Amplifier[] */
    private array $amplifiers;

    /**
     * @param int[] $memory
     */
    public function __construct(array $memory)
    {
        $this->amplifiers = [
            new Amplifier(new IntcodeComputer($memory)),
            // new Amplifier(new IntcodeComputer($memory)),
            // new Amplifier(new IntcodeComputer($memory)),
            // new Amplifier(new IntcodeComputer($memory)),
            // new Amplifier(new IntcodeComputer($memory)),
        ];
    }

    /**
     * @param int[] $phaseSequence
     */
    public function getThrusterSignal(array $phaseSequence): int
    {
        $output = 0;
        foreach ($this->amplifiers as $i => $amplifier) {
            $output = $amplifier->run([$phaseSequence[$i], $output]);
        }

        return (int) $output;
    }

    /**
     * @param int[] $phaseSequence
     */
    public function getThrusterSignalWithFeedbackLoop(array $phaseSequence): int
    {
        $output = 0;
        //for ($j = 0; $j < 2; $j++) {
            foreach ($this->amplifiers as $i => $amplifier) {
                $output = $amplifier->run([$phaseSequence[$i], $output]);
            }
        //}

        return (int) $output;
    }

    public function getMaxThrusterSignal(): int
    {
        $maxSignal = 0;

        foreach ($this->getPossiblePhaseSequence(0, 4) as $phaseSequence) {
            $maxSignal = max($maxSignal, $this->getThrusterSignal($phaseSequence));
        }

        return $maxSignal;
    }

    public function getMaxThrusterSignalWithFeedbackLoop(): int
    {
        $maxSignal = 0;

        foreach ($this->getPossiblePhaseSequence(5, 9) as $phaseSequence) {
            $maxSignal = max($maxSignal, $this->getThrusterSignalWithFeedbackLoop($phaseSequence));
        }

        return $maxSignal;
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
}
