<?php

namespace MyCsv;

class ParseWalker
{
    /**
     * @var bool
     */
    protected $lengthParsed = false;

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @param $string
     */
    public function parse($string)
    {
        $lines = preg_split("\r\n|\r|\n", $string);
        array_walk($lines, array($this, 'parseLine'));
    }

    /**
     * @param  string  $string
     * @return array|null
     */
    public function parseLine($string)
    {
        $string = trim($string);

        if (ParsePredictor::isEdge($string)) {
            $this->parseColumnsLength($string);
            return null;
        } elseif (ParsePredictor::isDataRow($string)) {
            return ParsePredictor::separate($string, $this->columns);
        } else {
            return null;
        }
    }

    /**
     * @param string  $string
     */
    protected function parseColumnsLength($string)
    {
        $this->lengthParsed = true;
        $this->columns = ParsePredictor::columnsLength($string);
    }
}