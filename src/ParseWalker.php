<?php

namespace MyCsv;

class ParseWalker
{
    /**
     * @var string
     */
    protected $newline = PHP_EOL;

    /**
     * @var string
     */
    protected $separator = ',';

    /**
     * @var bool
     */
    protected $lengthParsed = false;

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @param  string  $newline
     * @return $this
     */
    public function setNewLine($newline)
    {
        $this->newline = $newline;
        return $this;
    }

    /**
     * @param  string  $separator
     * @return $this
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
        return $this;
    }

    /**
     * @param  string  $string
     * @return string
     */
    public function parse($string)
    {
        $lines = preg_split('/(?>\r\n|[\r\n])/', $string);
        $data = array_map([$this, 'parseLine'], $lines);
        return implode($data);
    }

    /**
     * @param  string  $string
     * @return string
     */
    public function parseLine($string)
    {
        $string = trim($string);

        if (ParsePredictor::isEdge($string)) {
            $this->parseColumnsLength($string);
            return '';
        } elseif (ParsePredictor::isDataRow($string)) {
            return implode($this->separator, ParsePredictor::separate($string, $this->columns)) . $this->newline;
        } else {
            return '';
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