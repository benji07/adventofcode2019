<?php

namespace Benji07\AdventOfCode\Day14;

class ChemicalReaction
{
    /** @var Chemical */
    public Chemical $output;

    /** @var Chemical[] */
    public array $inputs;

    public function __construct(Chemical $output, Chemical ...$inputs)
    {
        $this->output = $output;
        $this->inputs = $inputs;
    }

    public function __toString()
    {
        return $this->output . ' = ' . implode(' + ', $this->inputs);
    }
}
