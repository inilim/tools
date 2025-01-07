<?php

namespace Inilim\Tool\Method\String;

/**
 * Remove all non-numeric characters from a string.
 */
function numbers(string $value): string
{
    return \preg_replace('/[^0-9]/', '', $value);
}

/**
 * Remove all non-numeric characters from a string.
 *
 * @param  string  $value
 * @return string
 */
    // public static function numbers($value)
    // {
    //     return preg_replace('/[^0-9]/', '', $value);
    // }
