<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day4;

class PasswordFinder
{
    public function count(int $min, int $max): int
    {
        $possiblePassword = [];
        foreach (range($min, $max) as $number) {
            if (!$this->assertTwoAdjacentDigits($number)) {
                continue;
            }

            if (!$this->assertDigitsNeverDecrease($number)) {
                continue;
            }

            $possiblePassword[] = $number;
        }

        return count($possiblePassword);
    }

    public function assertTwoAdjacentDigits(int $number): bool
    {
        $digits = str_split((string) $number);

        $compareDigit = $digits[0];
        for ($i = 1; $i < count($digits); ++$i) {
            if ($compareDigit == $digits[$i]) {
                return true;
            }

            $compareDigit = $digits[$i];
        }

        return false;
    }

    public function assertDigitsNeverDecrease(int $number): bool
    {
        $digits = str_split((string) $number);

        $compareDigit = $digits[0];
        for ($i = 1; $i < count($digits); ++$i) {
            if ($compareDigit > $digits[$i]) {
                return false;
            }

            $compareDigit = $digits[$i];
        }

        return true;
    }
}
