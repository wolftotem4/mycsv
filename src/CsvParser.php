<?php

namespace MyCsv;

class CsvParser
{
    /**
     * @param  string  $string
     * @param  string  $charList
     * @return bool
     */
    public static function isEscapingRequired($string, $charList = ",\r\n")
    {
        $quotation_mark = (substr($string, 0, 1) == '"') || (substr($string, -1) == '"');
        $in_charList    = preg_match('/[' . preg_quote($charList, '/') . ']/', $string);
        return $quotation_mark || $in_charList;
    }

    /**
     * @param  string  $string
     * @param  string  $charList
     * @return string
     */
    public static function escape($string, $charList = ",\r\n")
    {
        return static::isEscapingRequired($string, $charList) ? '"' . str_replace('"', '""', $string) . '"' : $string;
    }
}