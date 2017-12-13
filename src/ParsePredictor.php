<?php

namespace MyCsv;

class ParsePredictor
{
    const COLUMN_SEPARATOR = ' | ';

    /**
     * @param  string  $string
     * @return bool
     */
    public static function isEdge($string)
    {
        return (bool) preg_match('/^\+\-+(?:\+\-+)*\+$/', trim($string));
    }

    /**
     * @param  string  $string
     * @return array
     */
    public static function columnsLength($string)
    {
        return array_map(function ($string) {
            return strlen($string) - 2;
        }, explode('+', trim($string, "+ \t\n\r\0\x0B")));
    }

    /**
     * @param  string  $string
     * @return bool
     */
    public static function isDataRow($string)
    {
        return (bool) preg_match('/^\| .* \|$/', $string);
    }

    /**
     * @param  string  $string
     * @param  array   $lengthData
     * @param  string  $encoding
     * @return array
     */
    public static function separate($string, array $lengthData = [], $encoding = 'UTF-8')
    {
        (preg_match('/^\| (.*) \|$/', $string, $match)) and ($string = $match[1]);

        $row = explode(self::COLUMN_SEPARATOR, $string);

        $returnArray = [];
        if ($lengthData && substr_count($string, self::COLUMN_SEPARATOR) > count($lengthData) - 1) {
            foreach ($lengthData as $length) {
                $column = array_shift($row);
                $actual_length = mb_strwidth($column, $encoding);
                while ($actual_length < $length) {
                    $column .= self::COLUMN_SEPARATOR . array_shift($row);
                    $actual_length = mb_strwidth($column, $encoding);
                }

                $returnArray[] = $column;
            }
        }

        $returnArray = array_map('static::cleanSpace', array_merge($returnArray, $row));

        return $returnArray;
    }

    /**
     * @param  string  $string
     * @return string
     */
    protected static function cleanSpace($string)
    {
        return rtrim($string, ' ');
    }
}