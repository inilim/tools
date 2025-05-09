<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Repeat the given string.
 * @param int<0,max> $times
 */
function repeat(string $string, int $times): string
{
    if ($times < 0) {
        throw new \ValueError('Str::repeat(): Second argument has to be greater than or equal to 0');
    }
    return \str_repeat($string, $times);
}
