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
            new Amplifier(new IntcodeComputer($memory)),
            new Amplifier(new IntcodeComputer($memory)),
            new Amplifier(new IntcodeComputer($memory)),
            new Amplifier(new IntcodeComputer($memory)),
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

    public function getMaxThrusterSignal(): int
    {
        $maxSignal = 0;

        $phaseSequence = [];
        for ($i = 0; $i <= 4; ++$i) {
            $phaseSequence[0] = $i;
            for ($j = 0; $j <= 4; ++$j) {
                $phaseSequence[1] = $j;
                for ($k = 0; $k <= 4; ++$k) {
                    $phaseSequence[2] = $k;
                    for ($l = 0; $l <= 4; ++$l) {
                        $phaseSequence[3] = $l;
                        for ($m = 0; $m <= 4; ++$m) {
                            $phaseSequence[4] = $m;
                            if (count(array_unique($phaseSequence)) < count($this->amplifiers)) {
                                continue;
                            }

                            $maxSignal = max($maxSignal, $this->getThrusterSignal($phaseSequence));
                        }
                    }
                }
            }
        }

        return $maxSignal;
    }
}
