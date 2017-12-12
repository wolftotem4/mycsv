<?php

namespace Tests\MyCsv;

use MyCsv\ParsePredictor;
use PHPUnit\Framework\TestCase;

class ParsePredictorTest extends TestCase
{
    public function testIsEdge()
    {
        $string = '+---+----+';
        $returnValue = ParsePredictor::isEdge($string);

        $this->assertTrue($returnValue);
    }

    public function testColumnsLength()
    {
        $string = '+-----+------+----+';
        $returnValue = ParsePredictor::columnsLength($string);
        $expects = [3, 4, 2];

        $this->assertEquals($expects, $returnValue);
    }

    public function testSeparate()
    {
        $string = '| 中文 | dc | xyxyabc | ha |';

        $returnValue = ParsePredictor::separate($string);
        $this->assertEquals(['中文', 'dc', 'xyxyabc', 'ha'], $returnValue);

        $returnValue = ParsePredictor::separate($string, [9, 12]);
        $this->assertEquals(['中文 | dc', 'xyxyabc | ha'], $returnValue);
    }
}
