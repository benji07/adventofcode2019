<?php

namespace Benji07\AdventOfCode\Day14;

class Reaction
{
    /**
     * @var ChemicalReaction[]
     */
    public array $formulas;

    /**
     * @param ChemicalReaction[] $formulas
     */
    public function __construct(array $formulas = [])
    {
        $this->formulas = $formulas;
    }

    public function resolve(string $type): int
    {
        $formula = $this->formulas[$type];

        do {
            $previousFormula = $formula;
            $formula = $this->simplify($formula);

            echo $formula, "\n";
        } while ($previousFormula != $formula);

        // last one ?
        $formula = $this->simplify($formula, true);

        return $formula->inputs[0]->quantity;
    }

    public function simplify(ChemicalReaction $inputFormula, bool $allowWaste = false): ChemicalReaction
    {
        $newInputs = [];
        foreach ($inputFormula->inputs as $input) {
            if (!array_key_exists($input->type, $this->formulas)) {
                $newInputs[] = $input;

                continue;
            }

            $newFormula = $this->formulas[$input->type];

            if ($allowWaste && $newFormula->output->quantity > $input->quantity) {
                $newInputs = array_merge($newInputs, $newFormula->inputs);

                continue;
            }

            if (!$allowWaste && $newFormula->output->quantity > $input->quantity) {
                // do nothing for now
                $newInputs[] = $input;

                continue;
            }

            if (!$allowWaste && $newFormula->output->quantity < $input->quantity) {
                $multiplier = floor ($input->quantity/$newFormula->output->quantity);
                foreach ($newFormula->inputs as $newInput) {
                    $newInputs[] = new Chemical($newInput->quantity * $multiplier, $newInput->type);
                }

                $reste = $input->quantity - ($newFormula->output->quantity * $multiplier);

                $newInputs[] = new Chemical($reste, $newFormula->output->type);

                continue;
            }

            if ($allowWaste || $newFormula->output->quantity == $input->quantity) {
                $newInputs = array_merge($newInputs, $newFormula->inputs);
            }
        }

        $types = [];

        foreach ($newInputs as $input) {
            if (!array_key_exists($input->type, $types)) {
                $types[$input->type] = 0;
            }

            $types[$input->type] += $input->quantity;
        }

        ksort($types);

        $newInputs = [];
        foreach ($types as $type => $quantity) {
            $newInputs[] = new Chemical($quantity, $type);
        }

        return new ChemicalReaction($inputFormula->output, ...$newInputs);
    }
}
