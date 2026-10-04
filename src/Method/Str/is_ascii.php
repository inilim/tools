<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author https://github.com/voku/portable-ascii
 * 
 * Checks if a string is 7-bit ASCII.
 *
 * EXAMPLE: <code>
 * Str::is_ascii('白'); // false
 * </code>
 *
 * @param string $str <p>The string to check.</p>
 *
 * @psalm-pure
 *
 * @return bool
 *              <p>
 *              <strong>true</strong> if it is ASCII<br>
 *              <strong>false</strong> otherwise
 *              </p>
 */
function is_ascii(string $str): bool
{
    if ($str === '') {
        return true;
    }

    return !\preg_match('/' . "[^\x09\x10\x13\x0A\x0D\x20-\x7E]" . '/', $str);
}


/**
 * url: https://en.wikipedia.org/wiki/Wikipedia:ASCII#ASCII_printable_characters
 *
 * @var string
 */
// private static $REGEX_ASCII = "[^\x09\x10\x13\x0A\x0D\x20-\x7E]";