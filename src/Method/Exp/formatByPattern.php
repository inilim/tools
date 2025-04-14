<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author shaedrich <https://github.com/shaedrich>
 * Formats the input string accodring to the pattern passed in.
 *
 * @param  string  $string  the input string
 * @param  string  $pattern  asterisks will be replaced with the character
 *                           at the respective position of the input string
 *                           while other characters will put inserted as
 *                           is into the output string
 */
function formatByPattern(string $string, string $pattern)
{
    if (\strlen($string) !== \substr_count($pattern, '*')) {
        throw new \InvalidArgumentException('Number of placeholders must be the same as the length of the input string');
    }

    $res = '';
    $index = 0;

    for ($i = 0; $i < \strlen($pattern); $i++) {
        $res .= $pattern[$i] === '*' ? $string[$index++] : $pattern[$i];
    }

    return $res;
}
