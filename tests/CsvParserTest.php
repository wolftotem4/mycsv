<?php

namespace Tests\MyCsv;

use MyCsv\CsvParser;
use PHPUnit\Framework\TestCase;

class CsvParserTest extends TestCase
{
    public function testEscape()
    {
        $this->assertEquals('Hello World!', CsvParser::escape('Hello World!'));
        $this->assertEquals('Quote "quoted"!', CsvParser::escape('Quote "quoted"!'));
        $this->assertEquals('"""quotes"""', CsvParser::escape('"quotes"'));
        $this->assertEquals('"There,are,commas,among,us"', CsvParser::escape('There,are,commas,among,us'));
        $this->assertEquals("\"Mac\rLine Break\"", CsvParser::escape("Mac\rLine Break"));
        $this->assertEquals("\"Unix-like\nLine Break\"", CsvParser::escape("Unix-like\nLine Break"));
        $this->assertEquals("\"Win\r\nLine Break\"", CsvParser::escape("Win\r\nLine Break"));
        $this->assertEquals("\"Jack\tJenny\"", CsvParser::escape("Jack\tJenny", "\t"));
    }
}
