<?php

namespace MyCsv;


use PHPUnit\Framework\TestCase;

class ParseWalkerTest extends TestCase
{
    public function testParse()
    {
        $data = <<<DATA
+----------+------------+
| username | phone      |
+----------+------------+
| Bob      | 123-456789 |
| Mary     | 456-789123 |
+----------+------------+
DATA;

        $eol = PHP_EOL;
        $expect = "username\tphone{$eol}Bob\t123-456789{$eol}Mary\t456-789123{$eol}";

        $walker = new ParseWalker();
        $walker->setNewLine($eol)->setSeparator("\t");

        $this->assertEquals($expect, $walker->parse($data));
    }
}
