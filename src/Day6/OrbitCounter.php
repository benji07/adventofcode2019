<?php

declare(strict_types=1);

namespace Benji07\AdventOfCode\Day6;

class OrbitCounter
{
    /** @var Orbit[] */
    public array $orbits = [];

    /**
     * @param string[] $orbits
     */
    public function __construct(array $orbits = [])
    {
        foreach ($orbits as $orbit) {
            [$from, $to] = explode(')', trim($orbit));

            if (!array_key_exists($to, $this->orbits)) {
                $this->orbits[$to] = new Orbit($to);
            }

            if (!array_key_exists($from, $this->orbits)) {
                $this->orbits[$from] = new Orbit($from);
            }

            $this->orbits[$from]->addChild($this->orbits[$to]);
        }
    }

    public function count(): int
    {
        return (int) array_sum(array_map(static function (Orbit $orbit) {
            return $orbit->count();
        }, $this->orbits));
    }
}
