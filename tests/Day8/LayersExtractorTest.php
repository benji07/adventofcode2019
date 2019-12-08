<?php

namespace Benji07\AdventOfCode\Tests\Day8;

use Benji07\AdventOfCode\Day8\Layer;
use Benji07\AdventOfCode\Day8\LayersExtractor;
use PHPUnit\Framework\TestCase;

class LayersExtractorTest extends TestCase
{
    /**
     * @param string[][] $expectedLayers
     *
     * @dataProvider provideTestExtract
     */
    public function testExtract(string $input, int $width, int $height, array $expectedLayers): void
    {
        $extractor = new LayersExtractor();

        $this->assertEquals($expectedLayers, $extractor->extract($input, $width, $height));
    }

    public function provideTestExtract()
    {
        yield [
            '123456789012',
            3,
            2,
            [new Layer(['123','456']),new Layer(['789','012'])],
        ];
    }

    public function testGetSolution(): void
    {
        $extractor = new LayersExtractor();

        $layers = $extractor->extract('123456789012', 3, 2);
        $layer = $extractor->findCorrectLayer($layers);

        $this->assertEquals(1, $extractor->getSolution($layer));
    }

    public function testPart1()
    {
        $input = file(__DIR__.'/data/input.txt');

        $extractor = new LayersExtractor();

        $layers = $extractor->extract($input[3], 25, 6);

        $layer = $extractor->findCorrectLayer($layers);

        $this->assertEquals(1935, $extractor->getSolution($layer));
    }
}
